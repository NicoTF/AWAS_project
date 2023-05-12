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
- XSS: gli utenti possono inserire codice HTML e JS nel campo di testo, questo verrà salvato nel database e mostrato 
  nella pagina, quindi è possibile eseguire codice arbitrario
- File inclusion: gli utenti posso caricare foto, ma il contenuto del file non viene controllato
- Insecure Direct Object References: gli utenti possono accedere alle immagini di altri utenti