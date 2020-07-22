function updateValue(id) {
    window.location = "?menu=catu&cid=" + id;
}

function deleteValue(id) {
    let confirmation = window.confirm("Are you sure want to delete?");
    if (confirmation) {
        window.location = "?menu=cat&cmd=del&cid=" + id;
    }
}

function updatebookValue(isbn) {
    window.location = "?menu=booku&bid=" + isbn;
}

function deletebookValue(isbn) {
    let confirmation = window.confirm("Are you sure want to delete?");
    if (confirmation) {
        window.location = "?menu=book&cmd=del&bid=" + isbn;
    }
}