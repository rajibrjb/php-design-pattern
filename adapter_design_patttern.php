<?php


interface BookInterface {
    public function open();
    public function turnPage();
}

class Book implements BookInterface {

    public function open() {
        echo 'Opening the newturnPage paper book';
    }

    public function turnPage() {
        echo 'Turning page of the new paper book';
    }
}


interface eReaderInterface {
    public function turnOn();
    public function pressNextButton();
}

class Kindle implements eReaderInterface {

    public function turnOn() {
        echo 'Turn on the kindle';
    }

    public function pressNextButton() {
        echo 'Go to the next page';
    }
}

class KindleAdapter implements BookInterface {

    private $kindle;

    public function __construct(Kindle $kindle) {
        $this->kindle = $kindle;
    }

    public function open() {
        $this->kindle->turnOn();
    }

    public function turnPage() {
        $this->kindle->pressNextButton();
    }
}


class Person {

    public function read(BookInterface $book)
    {
        $book->open();
        $book->turnPage();
    }
}

(new Person)->read(new Book); // This will read a book and turn the page


// To use Kindle reader in the existing code we have to use adapter class
(new Person)->read(new kindleAdapter(new kindle)); 