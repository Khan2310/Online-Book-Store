$('#searchbox').keydown(function (event) {
	// 13 = ENTER key
	if(event.keyCode === 13) {
		const term = $('#searchbox').val();
		window.location = `searchresult.php?term=${term}&criteria=BOOKNAME`;
	}
});

$.post('search.php', { term: '', criteria: 'BOOKNAME' }, function (data) {
	for(let bookinfo of data.bookList) {
		$('#content_right').append(getMarkupForSingleBook(bookinfo));
	}
});
