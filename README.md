# symfony-okta-books-test-api

Symfony test secure CRUD API with Okta authentication.

React dashboard for this API:

https://github.com/radioaktive/react-octa-book-dashboard

React/Redux frontend for this API:

https://github.com/radioaktive/react-redux-test-books

#### API Endpoints

![](https://raw.githubusercontent.com/radioaktive/symfony-okta-books-test-api/master/docs/img/bookslist2.png)

/api/v1/books/list

methods="GET"

---

/api/v1/books/add

methods="POST"

(Authenticated)

---

/api/v1/books/by-id/{id}

methods="GET"

---
/api/v1/books/update/{id}

methods="POST"

(Authenticated)

---

/api/v1/books/{id}

methods="DELETE"

(Authenticated)


![](https://raw.githubusercontent.com/radioaktive/symfony-okta-books-test-api/master/docs/img/authorslist.png)

/api/v1/authors/list

methods="GET"

---

/api/v1/authors/add

methods="POST"

(Authenticated)

---

/api/v1/authors/by-id/{id}

methods="GET"

---

/api/v1/authors/update/{id}

methods="POST"

(Authenticated)

---

/api/v1/authors/{id}

methods="DELETE"

(Authenticated)
