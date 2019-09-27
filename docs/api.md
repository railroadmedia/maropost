# Contact API

# JSON Endpoints

## /maropost/json/sync-contact

### HTTP Request
    `POST /maropost/json/sync-contact`

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|email|yes|The contacts email. The email is the unique identifier.|
|body|first_name|no||
|body|last_name|no||
|body|custom_fields|no|Key value pairs, field must be created in maropost first.|
|body|tag_names_to_add|no|Array of tag names to add to contact.|
|body|tag_names_to_remove|no|Array of tag names to remove from contact.|
|body|list_ids_to_subscribe_to|no|Array of list ids to subscribe the contact to.|
|body|list_ids_to_unsubscribe_from|no|Array of list ids to unsubscribe the contact from.|


### Request Examples:

```js
$.ajax({
    type: 'POST',
    url: 'https://www.domain.com' +
             '/maropost/json/sync-contact',    
    data: {
        "email": "hello@gmail.com",
    }
    dataType: 'json',
    success: function(response) {},
    error: function(response) {}
});
```

```js
$.ajax({
    type: 'POST',
    url: 'https://www.domain.com' +
             '/maropost/json/sync-contact',    
    data: {
        "email": "hello@gmail.com",
        "first_name": 'Joe',
        "last_name": 'Hill',
        "custom_fields": {"my_field": "field value", "my_other_field": 12345},
        "tag_names_to_add": ["my_tag_name", "my_other_tag_name"],
        "tag_names_to_remove": ["tag_name_to_remove"],
        "list_ids_to_subscribe_to": [123, 2465],
        "list_ids_to_unsubscribe_from": [432, 4622],
    },
    dataType: 'json',
    success: function(response) {},
    error: function(response) {}
});
```

### Response Example (200):

```json
{
  "success": true
}
```

# Form Endpoints

## /maropost/form/sync-contact

### HTTP Request
    `POST /maropost/form/sync-contact`

### Request Parameters


|Type|Key|Required|Notes|
|----|---|--------|-----|
|body|email|yes|The contacts email. The email is the unique identifier.|
|body|first_name|no||
|body|last_name|no||
|body|custom_fields|no|Key value pairs, field must be created in maropost first.|
|body|tag_names_to_add|no|Array of tag names to add to contact.|
|body|tag_names_to_remove|no|Array of tag names to remove from contact.|
|body|list_ids_to_subscribe_to|no|Array of list ids to subscribe the contact to.|
|body|list_ids_to_unsubscribe_from|no|Array of list ids to unsubscribe the contact from.|
|body|success_redirect|no|Where to redirect the user after submission.|


### Request Examples:

```html
<form accept-charset="UTF-8"
      action="{{ url()->route('maropost.form.sync-contact') }}" 
      method="POST">

    <input name="email" type="email" placeholder="Email Address..." required/>
    
    <input name="first_name" type="text"/>
    <input name="last_name" type="text"/>

    <input name="tag_names_to_add[]" type="hidden" value="my_tag_name"/>
    <input name="tag_names_to_add[]" type="hidden" value="my_other_tag_name"/>
    
    <input name="tag_names_to_remove[]" type="hidden" value="my_tag_name_to_remove"/>
    <input name="tag_names_to_remove[]" type="hidden" value="my_other_tag_name_to_remove"/>
    
    <input name="list_ids_to_subscribe_to[]" type="hidden" value="123"/>
    <input name="list_ids_to_subscribe_to[]" type="hidden" value="2234613"/>
    
    <input name="list_ids_to_unsubscribe_from[]" type="hidden" value="312"/>
    <input name="list_ids_to_unsubscribe_from[]" type="hidden" value="163"/>

    <input name="success_redirect" type="hidden" value="/redirect/here/after/success"/>

    <input type="submit"/>
</form>
```

```html
<form accept-charset="UTF-8"
      action="{{ url()->route('maropost.form.sync-contact') }}" 
      method="POST">

    <input name="email" type="email" placeholder="Email Address..." required/>

    <input type="submit"/>
</form>
```

### Response Example (200):

Redirects back or to url passed in to 'success_redirect' param with messages flashed to session: 'success' => true.