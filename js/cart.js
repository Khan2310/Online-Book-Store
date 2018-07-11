
const onClickRemoveFromCart = function (userInfo) {
	$.post('cartService.php',
		{
			action: 'remove', //valid actions are 'add', 'remove' and 'updateQuantity'
			bookid: userInfo.BOOKID
		}, function () {
			alert('Book removed from cart');
			location.reload();
		})
		.fail(function(error) {
			alert(error.responseJSON.errorMessage);
		});
};

function getMarkupForSingleBook(bookDetails) {
	const container = $('<div>', { class: 'container' });
	const bookTitleContainer = $('<div>', { class: 'book-title'});
	const bookTitle = $('<span>');
	bookTitle.text(`${bookDetails.BOOKNAME} by ${bookDetails.AUTHOR}`);
	bookTitleContainer.append(bookTitle); container.append(bookTitleContainer);

	const bookDetailsContainer = $('<div>', { class: 'book-details' });
	const bookDetailsLeft = $('<div>	', { class: 'book-details-left'});
	const bookDetailsRight = $('<div>', { class: 'book-details-right'});

	bookDetailsLeft.append($('<div>', { style: `background: url(${bookDetails.IMAGE}) center center / contain no-repeat`}));

	bookDetailsRight.append($(`<div>${bookDetails.DESCRIPTION}</div>`));
	bookDetailsRight.append($(`<div class="price">৳${bookDetails.PRICE}</div>`));

	const removeFromCartButton = $('<button>');
	removeFromCartButton.text('Remove From Cart')
	removeFromCartButton.click(onClickRemoveFromCart.bind(null, bookDetails));

	bookDetailsRight.append(removeFromCartButton);

	bookDetailsContainer.append(bookDetailsLeft);
	bookDetailsContainer.append(bookDetailsRight);

	container.append(bookDetailsContainer);

	return container;
};


if(cart) {
  var flatCart = cart.reduce(function(a, b) {
    return a.concat(b);
  }, []);
	for(let bookinfo of flatCart) {
		$('#content_right').append(getMarkupForSingleBook(bookinfo));
	}
}
