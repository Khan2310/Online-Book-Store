
$("#searchButton").click(onClickSearch);

const searchCallback = function (data, status) {

	for(let bookinfo of data.bookList) {
		$('#searchContent').html(getMarkupForSingleBook(bookinfo));
	}
}

function onClickSearch() {
	const searchTerm = $("#searchbox-small").val();
	const searchCriteria = $("#categorySelect").val();

	//valitdate
	if(!searchTerm) {
		alert('no input found');
	}
	else {
		$.post('search.php', { term: searchTerm, criteria: searchCriteria }, searchCallback);
	}
}
