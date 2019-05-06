#ADMIN MODULES
@todo: create importer tool

<p>To create a new Admin Module, place a directory under Modules. The only required file is Index.php. The system will automaticlly search for this file and load it. Index.php should be treated as the entry point into your module.</p>

<hr>
<em>note: It was envisioned that Admin Modules would be built as React Apps but, we left this code open enough to allow you to do anything.</em>
<hr>

## Suggested Structure
+ Module Directory
  + views
  + assets 
    - src
  + Index.php
  + Page.php
  
## Autoloader - SPL
To take advantage of the Theme's SPL Autoload feature, your class will need to be nested in a namespace that matches the file directory. The parent namespace is `CTousignant`. The namespace into the Modules folder is `CTousignant\Admin\Modules`. If you had a module named `Pictures` the namespace for the module would be `CTousignant\Admin\Modules\Pictures`
  
## Adding an Admin Page
Create a class that extends CTousignant\Admin\Modules\Page or CTousignant\Admin\Modules\Subpage. Both classes contains abstract methods called `view` and `enqueue` and expect a closure to be returned. Return a voided closure if you do not wish to do anything.

The method `view` can be used to add content to the admin page.

The method `enqueue` can be used to add css/js to the admin page.

## Adding React
Includes SASS Compiler

1. pull react boilerplate repo into assets folder

        cd assets
        git clone git@github.com:tousignant-christopher/react-boilerplate.git
        
2. Move all contents from `/react-boilerplate` to directly under `/assets`
    
3. Install Grunt globally
    
        npm install grunt -g

4. Install Node modules
    
        npm install


## Run Grunt Tasks
To run a development build

    grunt
    
or

    npm run build
    
To run a distribution build

    grunt dist

or

    npm run dist