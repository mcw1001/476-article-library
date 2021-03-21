---
title:  'CP476 Project: BookIndex'
author: Michael Child-Wynne-Jones, Morgenne Besenschek, Chang Xing Li
date: 2021-03-22
---

## Introduction

BookIndex is a cross between a wiki and a book reviewing website.

It stores a books direct information (such as a summary, publishing information, etc) as well as external information, such as reviews, critical reception, sources/inspirations, and keywords.

A user will be able to login, search books, look at and sometimes edit articles.

 
## Problem solving and algorithms

The application will be able to display chains of works that refer to, or are inspired by other works using a BFS algorithm.

Essentially, a book may have a list of books that it cites as sources or that it was inspired by, and these books each have their own sources.

The client would be able to click a button to see the chain of books that eventually influenced the current book.

The BFS algorithm will take each source in a books Sources section and find that book (as well as its own sources, ignoring duplicates) and use this to create a "tree" of all the books that relate.

## System Design

The application will have a login page that will determine the users role, leading to a dynamic page with search functionality, book submission, and article editing features.

Access to certain pages depends on the user's role.

The login page will have the option for a user to login with a username and password, or continue as a guest.

The guest will be taken to the search page, but will have no other options.

If the user logs in as a user (with a first-level role) they will have book creation permissions, and can open a menu to add a book to the database.

The Home page will have a search form, as well as a form for adding a book. 

If the user logs in as an admin (a second-level role) they will have the book creation and editing permissions, allowing them to adjust content on the site and edit articles and book data (and also delete books).

The project will use html, JavaScript, Jquery, AJAX, PHP, MySQL, NodeJS, and XAMPP as tools.

## Milestones & schedule

| Task ID | Description   |  Due date | Lead   |  Role |
| :----:  | :------------ | :-----:   | :------: |  :-------: |
|  1      | Project research & team up | Day 5 of week 9 | Michael | -----
|  2      | Project proposal | Day 1 of week 10 | Michael | -----
|  3      | Project check point  | Day 1 of week 11 | Morgenne  | MySQL Database design
|  4      | Project check point  | Day 1 of week 11 | Michael  | BFS algorithm Implementation
|  5      | Project check point  | Day 1 of week 12  | Chang  | -----
|  6      | Project demonstration | Day 5 of week 12 | Michael  | -----
|  7      | Project submission | Day 5 of week 13 | Michael   | -----


## References

[Stackoverflow](https://stackoverflow.com)

