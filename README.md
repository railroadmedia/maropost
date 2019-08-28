# maropost
Maropost API For Laravel


ContactService
--------------------

All methods below are *public*.
Inject the `Railroad\Maropost\Services\ContactService` class where needed.

```php
/** @var Railroad\Maropost\Services\ContactService $contactService */
protected $contactService;
public function __constructor(Railroad\Maropost\Services\ContactService $contactService){
    $this->contactService = $contactService;
}
```
Include namespace at top of file:
```php
use Railroad\Maropost\Services\ContactService;
```
... to save yourself having to specify the namespace everywhere:
```php
/** @var ContactService $contactService */
protected $contactService;
public function __constructor(ContactService $contactService){
    $this->contactService = $contactService;
}
```

### createOrUpdate

Creates a contact without a list. Updates if already existing email is passed.

#### Usage Example
```php
$content = $this->contactService->createOrUpdate(ContactVO $contact);
```
#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  contact |  yes      |  ContactVO object  |  The contact object that should be create/update. | 
 
<!--
#, name, required, type, description
1 , id, yes, integer , id of content you want to pull  
-->
#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#281 <br/>   +"id": 430 <br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |

### update

Update a contact without a list, based on id. This method should be used when update the email address.

#### Usage Example
```php
$content = $this->contactService->update($contactId, ContactVO $contact);
```
#### Parameters
| # | name | required | type | description |
|:---:|:---------:|:--------:|------------------|-------------------------------------------|
| 1 | contactId | yes | integer | Contact id |
| 2 | contact | yes | ContactVO object | The contact object that should be update. |
<!--
#, name, required, type, description
1 , id, yes, integer , id of content you want to pull  
-->
#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#281 <br/>   +"id": 430 <br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |


### findOneByEmail

Gets the contact according to email address

#### Usage Example
```php
$content = $this->contactService->findOneByEmail($email);
```
#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  email |  yes      |  string  |  Email address of the contact | 
 

#### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#281 <br/>   +"id": 430 <br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |


### findOneById

Gets the contact based on id

#### Usage Example
```php
$content = $this->contactService->findOneById($id);
```
#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  id |  yes      |  integer  |  Contact id | 
 

#### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#281 <br/>   +"id": 430 <br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |


### addContactToLists

Add contact to specified lists.

#### Usage Example
```php
$content = $this->contactService->addContactToLists($listIds, $contactId);
```
#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | listIds | yes | array | The lists ids where the contact will be assigned |
| 2 | contactId | yes | integer | The contact id|
 
#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#248<br/>   +"id": 430<br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": array:1 [<br/>     0 => {#270<br/>       +"list_id": 1<br/>       +"name": "test"<br/>       +"status": "Subscribed"<br/>       +"created_at": "2019-08-23T07:43:58.000-04:00"<br/>       +"updated_at": "2019-08-23T07:43:58.000-04:00"<br/>     }<br/>   ]<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |


### removeContactFromLists

Remove contact from specified lists.


#### Usage Example
```php
$content = $this->contactService->removeContactFromLists($listIds, $contactId);
```
#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | listIds | yes | array | The lists ids |
| 2 | contactId | yes | integer | The contact id. |
 
#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#248<br/>   +"id": 430<br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": array:1 [<br/>     0 => {#270<br/>       +"list_id": 1<br/>       +"name": "test"<br/>       +"status": "Unsubscribed"<br/>       +"created_at": "2019-08-23T07:43:58.000-04:00"<br/>       +"updated_at": "2019-08-23T08:56:30.000-04:00"<br/>     }<br/>   ]<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |

### getListContacts

Gets the list of contacts for the specified list

#### Usage Example
```php
$content = $this->contactService->getListContacts($listId);
```
#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | listId | yes | integer | The list id |

 
#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | array | array:3 [<br/>   0 => {#281<br/>     +"id": 427<br/>     +"account_id": 2124<br/>     +"email": "caleb+testmanual@drumeo.com"<br/>     +"first_name": null<br/>     +"last_name": null<br/>     +"created_at": "2019-08-08T18:00:33.000-04:00"<br/>     +"updated_at": "2019-08-08T18:00:33.000-04:00"<br/>     +"uid": null<br/>     +"subscription": {#279<br/>       +"status": "Subscribed"<br/>       +"subscribed_at": "2019-08-08T18:00:33.000-04:00"<br/>       +"updated_at": "2019-08-08T18:00:33.000-04:00"<br/>     }<br/>     +"total_pages": 1<br/>   }<br/>   1 => {#250<br/>     +"id": 426<br/>     +"account_id": 2124<br/>     +"email": "caleb+test1@drumeo.com"<br/>     +"first_name": "caleb"<br/>     +"last_name": "favor"<br/>     +"created_at": "2019-08-08T17:33:48.000-04:00"<br/>     +"updated_at": "2019-08-22T07:23:55.000-04:00"<br/>     +"uid": null<br/>     +"subscription": {#276<br/>       +"status": "Subscribed"<br/>       +"subscribed_at": "2019-08-08T18:12:56.000-04:00"<br/>       +"updated_at": "2019-08-08T18:12:56.000-04:00"<br/>     }<br/>     +"total_pages": 1<br/>   }<br/>   2 => {#269<br/>     +"id": 430<br/>     +"account_id": 2124<br/>     +"email": "roxana@drumeo.com"<br/>     +"first_name": null<br/>     +"last_name": null<br/>     +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>     +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>     +"uid": null<br/>     +"subscription": {#248<br/>       +"status": "Unsubscribed"<br/>       +"subscribed_at": "2019-08-23T07:43:58.000-04:00"<br/>       +"updated_at": "2019-08-23T08:56:30.000-04:00"<br/>     }<br/>     +"total_pages": 1<br/>   }<br/> ] |  |


### deleteContactByEmail

Deletes specified contact from all the lists. 

#### Usage Example
```php
$content = $this->contactService->deleteContactByEmail($email);
```
#### Parameters

| # | name | required | type | description |
|---|-----|--------|--------|------------------------------|
| 1 | email | yes | string | Email address of the contact |

#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#249<br/>   +"id": 430<br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |


### addTagsToContact

Add tags to contact

#### Usage Example
```php
$content = $this->contactService->addTagsToContact($contactId, $tags);
```

#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | contactId | yes | integer | The contact id|
| 2 | tags | yes | array | An array with the tags name that should be added |

#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | array | {#249<br/>   +"id": 430<br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": array:1 [<br/>     0 => {#270<br/>       +"name": "test_tag"<br/>       +"created_at": "2019-08-23T09:21:22.000-04:00"<br/>     }<br/>   ]<br/> } |  |


### removeTagsFromContact

Remove specified tags from contact

#### Usage Example
```php
$content = $this->contactService->removeTagsFromContact($contactId, $tags);
```
#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | contactId | yes | integer | The contact id|
| 2 | tags | yes | array | An array with the tags name that should be removed |

#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | array | {#249<br/>   +"id": 430<br/>   +"account_id": 2124<br/>   +"email": "roxana@drumeo.com"<br/>   +"first_name": ""<br/>   +"last_name": ""<br/>   +"created_at": "2019-08-20T09:30:17.000-04:00"<br/>   +"updated_at": "2019-08-21T04:18:53.000-04:00"<br/>   +"uid": null<br/>   +"orders": []<br/>   +"list_subscriptions": []<br/>   +"workflows": []<br/>   +"tags": []<br/> } |  |


ListService
--------------------

All methods below are *public*.
Inject the `Railroad\Maropost\Services\ListService` class where needed

```php
/** @var Railroad\Maropost\Services\ListService $listService */
protected $listService;
public function __constructor(Railroad\Maropost\Services\ListService $listService){
    $this->listService = $listService;
}
```
Include namespace at top of file:
```php
use Railroad\Maropost\Services\ListService;
```
... to save yourself having to specify the namespace everywhere:
```php
/** @var ListService $listService */
protected $listService;
public function __constructor(ListService $listService){
    $this->listService = $listService;
}
```
### index
Gets the lists

#### Usage Example
```php
$content = $this->listService->index();
```

#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | noCounts | no | boolean | Default set 'no'. Set true to get description of lists other than counts, for faster results|

#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | array | array:[<br/>   0 => {#281<br/>     +"id": 1<br/>     +"account_id": 2124<br/>     +"name": "test"<br/>     +"address": """<br/>       93208 Pansy Knolls\n<br/>       East Annemouth, MT 95156-7534<br/>       """<br/>     +"language": "st"<br/>     +"from_name": ""<br/>     +"from_email": ""<br/>     +"reply_to_email": ""<br/>     +"add_to_unsubscribe_page": false<br/>     +"refreshed_at": "2019-08-08T22:55:29.000-04:00"<br/>     +"subscribers": 2<br/>     +"unsubscribes": 0<br/>     +"soft_bounces": 0<br/>     +"hard_bounces": 0<br/>     +"post_url": null<br/>     +"list_type": "normal"<br/>     +"folder_id": null<br/>     +"brand_id": null<br/>     +"crm_entity_id": null<br/>     +"created_at": "2019-08-08T17:37:38.000-04:00"<br/>     +"updated_at": "2019-08-22T07:25:12.000-04:00"<br/>     +"display_name": ""<br/>     +"description": ""<br/>     +"total_revenue": 0.0<br/>     +"complaints_count": 0<br/>     +"total_contacts_count": 2<br/>     +"total_pages": 1<br/>   }<br/>   1 => {#279<br/>     +"id": 2<br/>     +"account_id": 2124<br/>     +"name": "Maropost_test"<br/>     +"address": "31265 Wheel Avenue, #107 Abbotsford British Columbia V2T 6H2 Canada"<br/>     +"language": "en"<br/>     +"from_name": ""<br/>     +"from_email": ""<br/>     +"reply_to_email": ""<br/>     +"add_to_unsubscribe_page": false<br/>     +"refreshed_at": "2019-08-14T16:35:37.000-04:00"<br/>     +"subscribers": 2<br/>     +"unsubscribes": 0<br/>     +"soft_bounces": 0<br/>     +"hard_bounces": 0<br/>     +"post_url": null<br/>     +"list_type": "normal"<br/>     +"folder_id": null<br/>     +"brand_id": null<br/>     +"crm_entity_id": null<br/>     +"created_at": "2019-08-14T11:48:29.000-04:00"<br/>     +"updated_at": "2019-08-14T16:35:39.000-04:00"<br/>     +"display_name": ""<br/>     +"description": ""<br/>     +"total_revenue": 0.0<br/>     +"complaints_count": 0<br/>     +"total_contacts_count": 2<br/>     +"total_pages": 1<br/>   }<br/> ] |  |

### create
Create a new list.

#### Usage Example
```php
$content = $this->listService->create(ListVO $list);
```

#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  list |  yes      |  ListVO object  |  The list object that should be create. | 
 
 
#### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#282<br/>   +"id": 14<br/>   +"account_id": 2124<br/>   +"name": "quos"<br/>   +"address": """<br/>     9996 Gerhard Port\n<br/>     South Baron, IN 85715<br/>     """<br/>   +"language": "sw"<br/>   +"from_name": ""<br/>   +"from_email": ""<br/>   +"reply_to_email": ""<br/>   +"contacts_count": 0<br/>   +"add_to_unsubscribe_page": false<br/>   +"refreshed_at": "2019-08-23T09:38:59.654-04:00"<br/>   +"subscribers": null<br/>   +"unsubscribes": null<br/>   +"soft_bounces": null<br/>   +"hard_bounces": null<br/>   +"post_url": null<br/>   +"list_type": "normal"<br/>   +"folder_id": null<br/>   +"brand_id": null<br/>   +"crm_entity_id": null<br/>   +"created_at": "2019-08-23T09:38:59.655-04:00"<br/>   +"updated_at": "2019-08-23T09:38:59.655-04:00"<br/>   +"display_name": ""<br/>   +"description": ""<br/>   +"total_revenue": null<br/> } |  |

### update
Modify a list.

#### Usage Example
```php
$content = $this->listService->update($id, ListVO $list);
```


#### Parameters
| # | name | required | type | description |
|---|---------|----------|------------------|--------------------------------------------------|
| 1 | id | yes | integer | The list id |
| 2 | list | yes | ListVO object | The list object with the new values |

#### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#282<br/>   +"id": 14<br/>   +"account_id": 2124<br/>   +"name": "quos"<br/>   +"address": """<br/>     82810 Eldred Station Apt. 770\n<br/>     West Gwen, ND 58734-8710<br/>     """<br/>   +"language": "en"<br/>   +"from_name": ""<br/>   +"from_email": ""<br/>   +"reply_to_email": ""<br/>   +"contacts_count": 0<br/>   +"add_to_unsubscribe_page": false<br/>   +"refreshed_at": "2019-08-23T09:38:59.654-04:00"<br/>   +"subscribers": null<br/>   +"unsubscribes": null<br/>   +"soft_bounces": null<br/>   +"hard_bounces": null<br/>   +"post_url": null<br/>   +"list_type": "normal"<br/>   +"folder_id": null<br/>   +"brand_id": null<br/>   +"crm_entity_id": null<br/>   +"created_at": "2019-08-08T17:37:38.000-04:00"<br/>   +"updated_at": "2019-08-23T09:42:38.009-04:00"<br/>   +"display_name": ""<br/>   +"description": ""<br/>   +"total_revenue": null<br/> } |  |

### delete
Delete a list.

#### Usage Example
```php
$content = $this->listService->delete($listId);
```

### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  listId |  yes      |  integer  |  The list id. | 
 
### Responses
Null

### show
Pull list with specified id.

#### Usage Example
```php
$content = $this->listService->show($listId);
```

### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  listId |  yes      |  integer  |  The list id. | 
 
### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#282<br/>   +"id": 14<br/>   +"account_id": 2124<br/>   +"name": "quos"<br/>   +"address": """<br/>     82810 Eldred Station Apt. 770\n<br/>     West Gwen, ND 58734-8710<br/>     """<br/>   +"language": "en"<br/>   +"from_name": ""<br/>   +"from_email": ""<br/>   +"reply_to_email": ""<br/>   +"contacts_count": 0<br/>   +"add_to_unsubscribe_page": false<br/>   +"refreshed_at": "2019-08-23T09:38:59.654-04:00"<br/>   +"subscribers": null<br/>   +"unsubscribes": null<br/>   +"soft_bounces": null<br/>   +"hard_bounces": null<br/>   +"post_url": null<br/>   +"list_type": "normal"<br/>   +"folder_id": null<br/>   +"brand_id": null<br/>   +"crm_entity_id": null<br/>   +"created_at": "2019-08-08T17:37:38.000-04:00"<br/>   +"updated_at": "2019-08-23T09:42:38.009-04:00"<br/>   +"display_name": ""<br/>   +"description": ""<br/>   +"total_revenue": null<br/> } |  |


TagService
--------------------

All methods below are *public*.
Inject the `Railroad\Maropost\Services\TagService` class where needed

```php
/** @var Railroad\Maropost\Services\TagService $tagService */
protected $tagService;
public function __constructor(Railroad\Maropost\Services\TagService $tagService){
    $this->tagService = $tagService;
}
```
Include namespace at top of file:
```php
use Railroad\Maropost\Services\TagService;
```
... to save yourself having to specify the namespace everywhere:
```php
/** @var TagService $tagService */
protected $tagService;
public function __constructor(TagService $tagService){
    $this->tagService = $tagService;
}
```


### create
Create a new tag.

#### Usage Example
```php
$content = $this->tagService->create(TagVO $tag);
```
### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  tag |  yes      |  TagVO object  |  The TagVO object that should be created. | 

### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#282<br/>   +"id": 25<br/>   +"name": "culpa"<br/>   +"account_id": 2124<br/>   +"created_at": "2019-08-23T09:51:50.293-04:00"<br/>   +"updated_at": "2019-08-23T09:51:50.293-04:00"<br/>   +"folder_id": null<br/> } |  |


### findByName
Find a tag by name.

#### Usage Example
```php
$content = $this->tagService->findByName($name);
```
#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  name |  yes      |  string  |  The tag name. | 

#### Responses

| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#282<br/>   +"id": 25<br/>   +"name": "culpa"<br/>   +"account_id": 2124<br/>   +"created_at": "2019-08-23T09:51:50.293-04:00"<br/>   +"updated_at": "2019-08-23T09:51:50.293-04:00"<br/>   +"folder_id": null<br/> } |  |


### findById
Find a tag by id.

#### Usage Example
```php
$content = $this->tagService->findById($tagId);
```
#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  tagId |  yes      |  integer  |  The tag id. | 

#### Responses
| outcome | return data type | return data value | notes |
|----------|------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|
| failed | null | null |  |
| succeded | stdClass | {#282<br/>   +"id": 25<br/>   +"name": "culpa"<br/>   +"account_id": 2124<br/>   +"created_at": "2019-08-23T09:51:50.293-04:00"<br/>   +"updated_at": "2019-08-23T09:51:50.293-04:00"<br/>   +"folder_id": null<br/> } |  |


### delete
Delete tag

#### Usage Example
```php
$content = $this->tagService->delete($tagId);
```

#### Parameters
| #  |  name             |  required |  type    |  description                        | 
|----|-------------------|-----------|----------|-------------------------------------| 
| 1  |  tagId |  yes      |  integer  |  The tag id. | 

#### Responses

Null

