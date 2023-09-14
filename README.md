# Telefonbuch Dokumentation
****
### Requirements
- linux
- nginx or apache server
- PHP (>= 8.1)
- PHP package PDO
- MySQL (innoDB)


### Installation
``With zip file``
- Unzip in your public server direction (localhost) p.e. /var/www/html/  

``Use repository``
- clone application from this GitHub repository.  
  in your public server direction (localhost) p.e. /var/www/html/

``Prepare your database``
- Set your database credentials in ``app/defines/database.define.php`` 
- Import telefonbuch.sql into Database

### URL

    localhost/telefonbuch

### Application
- app/controller/IndexController.class

  Manage POST request from forms
- app/service/AddressBookService.class

  Manage address book data
- app/api/PdoApi.class

  Manage Database handling
- app/api/T9Api.class

  Manage T9 search handling

### Description
- Simple code example using PHP for processing and displaying forms.


- The URL call creates an instance of the IndexController and  
provides the data for the template output.  
  ``app/controller/IndexController.class.php``


- Any form action called by ```instance->setFormAction```,  
if $_POST[form_action] exists.  


- ``Class PdoApi`` is the database handler in ``app/api/PdoApi.class.php``


- ``Class T9Api`` is the t9 number handler in ``app/api/T9Api.class.php``


- ``Class AddressBookService`` Service handler in ``app/service/AddressBookService.class.php``


****
#### @author

  Stefan Chrobak / info@netcodev.de


#### @copyRight

www.netcodev.de / Stefan Chrobak
****