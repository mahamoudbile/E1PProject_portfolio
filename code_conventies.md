# code conventions for Project P_E1

1. **camelCase** for names(variables en functions), for example:
    ```php
    $colorPage = 'red'
    ```

2. all names start with letters, for example

    ```php
    function adminProject
    ```

3. put space around the operators and commas (+ - * / = ,), for example
    ```php
    let x = y + z; //here used space between operators
    const carBrands = ['seat' , 'volvo', 'audi']; // here used space between commas
    ```

4. tab space indentation for code blocks, for example
    ````php
    function codeTab(tab) {
        return tab; //here used oneTab space
    }
    ```


# rules for compound statements
5. 
 - put the opening bracket '{' at the end of the first line, 
 - use one space before the opening bracket
 - put the closing brack '}' on a new line without spaces
 - do not end with a with a semicolon
 
 ````php
 function compoundRules() { //this is openingBracket
    oneSpaceBeforeTheOpening Bracket;
 } //this is closingBracket
 ```

# object rules
6.
 - put the opening bracket '{' at the end of the first line
 - use one space between the property and value
 - use quotes around string values
 - use comma after each property-value pair, but do not use comma after last one
 - put the end brack on a new line without spaces
 - always end an object definition with a semicolon

 ```php
 const carProperty = { // this is opening bracket
    color: "red", //here we used quotos around the value string
    name: "volvo", // here we use comma between the two property-value pair
 }; // this is closing bracket, we put the closing brack on a new line without space and used semicolon
 ```
