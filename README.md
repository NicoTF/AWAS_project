# AWAS Project
Nicolò Tagliaferro, Damiano Salvaterra


## Requirements
- PHP: 7.0+
- PHP sqlite extension: To enable it, uncomment the line `extension=pdo_sqlite` in the php.ini file

## How to run
To launch the server just execute the command 
```bash
php -S localhost:8080
```
from the _public_ folder, the website will be accessible from http://localhost:8080


# Idee progetto e vulnerbilità
Blog dove gli utenti possono condividere immagini, le immagini vanno caricate (verranno salvate nel server) e verrà
assegnato un ID alla risorsa, per accedere all'immagine si usa uno script ```get_image.php?id=ID```, lo script risponde 
col contenuto del file, gli utenti possono caricare delle immagini 
private ma **lo script non effettuerà controlli e consentirà di visualizzare le immagini di altri utenti**


## Vulnerabilità
- Insecure Direct Object References: the users can access any file in the server by exploiting the script
  ```/content/get_secured_picture.php?name=<file-name>```. The file name is base64 encoded.
This file is not directly accessible by the website but it can be found by looking at the source html of the home page. The script is used to generate the images presented on the home page. If the attacker manually request the URL ```/content/get_secured_picture.php?```, he is gets a blank page and than he can manually fill the GET parameter *filename*. By looking at the requests made by the home page to this script, it can be seen that the GET parameter is base64 encoded. The attacker can try to request some random file, thus the page will return a message "FIle not found" with the path in which the script searches the file. The attacker now knows that the script is searching in the /images directory. Now, if the attakcer wants, for example, get the /index.php file, he can first try to enumerate the directories looking for common directory names, like *public*, and then he can base 64 encode the string *../public/index.php* and make a GET request with this string encoded. The script will return the file requested without performing any other control. 
- SQL injection: the file ```/public/search.php``` contains  SQL injection that enable attackers to visualize the password contained in the database. The page is a form that let you search for username beginning with a specified prefix, but it hides a UNION based SQL injection and it can be exploited filling the form with the string "*'UNION SELECT id, password FROM users --*". This happens because there is no control on the input of the form. The number of columns that have to be included in the select can be guessed by trying first with one column. In this case the script will generate an error (wich is not printed out on the client) and the page will be returned empty(for example with the string "*'UNION SELECT null FROM users --*"). If we fill the form with the string "*'UNION SELECT null,null FROM users --*" the script will return an empty, but valid response. This means that the query is made with the selection of 2 columns. This enable the attacker to guess the name of the columns and the table. 
- Stored XSS: when publishing a post, the description is not sanitized and it is possible to insert a script that will be executed when the post is visualized.