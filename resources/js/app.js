import './bootstrap';
import jQuery from 'jquery';

window.$ = jQuery;

const patternItem = $('#pattern-list-item');

const refreshAllAds = () => {
	const list = $('#list');

	list.empty();
	list.append($('<div>').text('Loading...'));

	axios.get('/api/olx/list').then((response) => {
		list.empty();

		if (response.data.length === 0)
		{
			list.append($('<div>').text('No ads found'));
			return;
		}

		response.data.forEach((item) => {
			const newItem = patternItem.clone();
			newItem.find('.item-title').text(item.title);
			newItem.find('.item-description').html(item.description.substring(0, 100)
				.replaceAll('\\u003C', '<')
				.replaceAll('\\u003E', '>')
				.replaceAll('\\n', '<br>')
			);
			newItem.find('.item-price').text(item.last_price);
			newItem.find('.item-currency').text(item.currency);
			newItem.find('.item-last-change-at').text(new Date(item.updated_at).toLocaleString());
			newItem.find('.item-link').attr('href', item.url);
			newItem.find('.item-image').attr('src', item.photos[0] || 'https://via.placeholder.com/150');
			list.append(newItem);

			newItem.find('.item-delete').on('click', (e) => {
				e.preventDefault();
				axios.delete(`/api/olx/delete/${item.id}`).then(() => {
					newItem.remove();
				}).catch((error) => {
					console.error(error);
				}).finally(() => refreshAllAds());
			});
		});
	}).catch((error) => {
		list.empty();
		list.append($('<div>').text(`Error: ${error}`));
		console.error(error);
	});
};

$(document).ready(() => {
	refreshAllAds();

	$('#add').on('click', (e) => {
		e.preventDefault();

		const url = $('#url').val();
		const email = $('#email').val();
		if (!url || !email)
		{
			alert('Fill all fields');
			return;
		}

		axios.post('/api/olx/add', {
			url,
			email
		}).then(() => {
			$('#url').val('');
			refreshAllAds();
			alert('Ad added');
		}).catch((error) => {
			alert('Error: ' + (error.response?.data?.message || error));
		});
	});
});