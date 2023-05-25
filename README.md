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
- SQL injection: 
The file ```/public/search.php``` contains a SQL injection vulnerability that allows attackers to retrieve the password stored in the database. The page is a search form that allows users to search for usernames starting with a specified prefix. However, it is susceptible to a UNION-based SQL injection attack. This vulnerability can be exploited by filling the form with the following string: "'UNION SELECT id, password FROM users --". The lack of input validation on the form allows this attack to occur. To determine the number of columns to include in the SELECT statement, an attacker can start by trying with just one column. In this case, the script will generate an error (which is not displayed to the client), and the page will be returned empty. For example, the string "'UNION SELECT null FROM users --" can be used. By filling the form with the string "'UNION SELECT null,null FROM users --", the script will return an empty response, indicating that the query is executed with the selection of two columns. This allows the attacker to guess the names of the columns and the table involved in the query.
- Stored XSS: when publishing a post, the description is not sanitized and it is possible to insert a script that will be executed when the post is visualized.
