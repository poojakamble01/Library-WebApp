<?php
// function get_author_count(){
// 	$connection = mysqli_connect("localhost","root","");
// 	$db = mysqli_select_db($connection,"webapp");
// 	$author_count = 0;
// 	$query = "select count(*) as author_count from authors";
// 	$query_run = mysqli_query($connection,$query);
// 	while ($row = mysqli_fetch_assoc($query_run)){
// 		$author_count = $row['author_count'];
// 	}
// 	return($author_count);
// }

function get_user_count()
{
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "webapp");
	$user_count = 0;
	$query = "select count(*) as user from reg";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$user_count = $row['user'];
	}
	return ($user_count);
}

function get_book_count()
{
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "webapp");
	$book_count = 0;
	$query = "select count(*) as book_count from addbook";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$book_count = $row['book_count'];
	}
	return ($book_count);
}

function get_issue_book_count()
{
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "webapp");
	$issue_book_count = 0;
	$query = "select count(*) as issue_book_count from issued_books";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$issue_book_count = $row['issue_book_count'];
	}
	return ($issue_book_count);
}

function get_category_count()
{
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "webapp");
	$cat_count = 0;
	$query = "select count(*) as cat_count from issuebookbyuser";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$cat_count = $row['cat_count'];
	}
	return ($cat_count);
}
function get_stock_book_count()
{
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "webapp");
	$book_count = 0;
	$query = "select count(*) as stock_book_count from addbook where availability = 'Unavailable'";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$book_count = $row['stock_book_count'];
	}
	return ($book_count);
}


?>