# Datastone obfuscate
Obfuscate an email or other strings to prevent spam-bots from sniffing it.

## Installation

Install the plugin via the Craft CMS control panel or via the command line:

   ```bash
   composer require datastone/craft-obfuscate
   ```
   ```bash
   ./craft plugin/install datastone-obfuscate
   ```

## Usage
twig filter:

In the simplest form you can use
````twig
{{ "email@example.com" | obfuscate }}
````

# Roadmap

- add other methods to obfucate email like text directions
- css and javascript tricks

---
### More advance usage:
````twig
{{ string $str | [, obfuscate | obfuscateEmail | obfuscateMailTo] }}
````
````twig
craft extension:
{{ craft.obfuscator.obfuscate(string $str) }}
{{ craft.obfuscator.email(string $email) }}
{{ craft.obfuscator.mailto(string $email) }}
````

obfuscateMailTo:
````twig
{{ string $email | obfuscateMailTo([string $title [, $json ]]) }}
{{ craft.obfuscator.mailto(string $email [, string $title [, $json ]]) }}
````
 example : 
````twig
{{ 'exm@test.nl' | obfuscateMailTo('title', {'class' : 'className', 'attr' : ''}) }}
````
output  : 
````html
<a href="mailto:exm@test.nl" class="className" attr>title</a>
````
string concat: (notice the () for twig otherwise the parsing goes wrong!)
````twig
{{ ('Some string to hide ' ~ foo.bar) | obfuscate }}
{{ craft.obfuscator.obfuscate('Some string to hide ' ~ foo.bar) }}
````

