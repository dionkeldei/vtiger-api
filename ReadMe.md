# ibizaCRM - Docs

## Select(table, campo, valor)
Selecciona toda la tabla y regresa un objeto con todos los datos del contacto elegido.

**table:**

>Es la tabla a la cual se va a consultar.

`Accounts`
`Leads`
`Contacts`
`HelpDesk`

**id:**

>Es el id del contacto que se quiere obtener.
>Si no especificas campo y valor, regresara la tabla completa.

```4x65478```


Ejemplo:

```
use dionkeldei/VtigerCRM/CRM as vtigerCRM;

public function index{
  $crm = new vtigerCRM;
  $datos = $crm->Select('Accounts','id','3x1234');
  print_r($datos);
}
```

## Update(table, id, data)
Selecciona toda la tabla y regresa un objeto con todos los datos del contacto elegido.

**table:**

>Es la tabla a la cual se va a consultar.

`Accounts`
`Leads`
`Contacts`
`HelpDesk`

**id:**

>Es el id del contacto que se quiere obtener.

```4x65478```

**data:**

>Es un array con los datos que se van a actualizar de la tabla.

```
$data = array(
     'email' => "mimail@mail.com",
     'phone' => "45-675-98"
     );
```


Ejemplo:

```
use dionkeldei/VtigerCRM/CRM as vtigerCRM;

public function index{
  $crm = new vtigerCRM;
  $data = array(
     'email' => "mimail@mail.com",
     'phone' => "45-675-98"
     );
  $datos = $crm->Update('Accounts','3x1234',$data);
  print_r($datos);
}
```


## Create(table,Data)
Crea un registro nuevo en CRM.

**table:**

>Es la tabla a la cual se va a agregar.

`Accounts`
`Leads`
`Contacts`
`Users`
`HelpDesk`

**data:**

>Es un array con los datos que se van a agregar en la tabla. *Nota: Cada CRM tiene datos Obligatorios, revisar la documentaci¨®n

```
$data = array(
     'email' => "mimail@mail.com",
     'phone' => "45-675-98"
     );
```


Ejemplo:

```
use dionkeldei/VtigerCRM/CRM as vtigerCRM;

public function index{
  $crm = new vtigerCRM;
  $data = array(
     'email' => "mimail@mail.com",
     'phone' => "45-675-98"
     );
  $datos = $crm->Create('Accounts',$data);
  print_r($datos);
}
```

## Config()
Muestra los datos de acceso de el CRM.


Ejemplo:

```
use ibizaBMB/VtigerCRM/CRM as vtigerCRM;

public function index{
  $CRM = new vtigerCRM;
         $datos = $CRM->Config();
         print_r($datos);
}
```
