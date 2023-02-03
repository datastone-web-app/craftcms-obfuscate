# Datastone obfuscate
Obfuscate an email or other strings to prevent spam-bots from sniffing it.

## Usage
twig filter:

In the simplest form you can use
````twig
{{ "email@exemple.com" | obfuscate }}
````

# Roadmap

- add other methods to obfucate email like text directions
- css and javascript tricks

---
### More advance usage (which you probably wont need):
````twig
{{ string $str | [, obfuscate | obfuscateEmail | obfuscateMailTo] }}
````
````twig
craft extension:
{{ craft.dsObfuscate.obfuscate(string $str) }}
{{ craft.dsObfuscate.email(string $email) }}
{{ craft.dsObfuscate.mailto(string $email) }}
````

obfuscateMailTo:
````twig
{{ string $email | obfuscateMailTo([string $title [, $json ]]) }}
{{ craft.dsObfuscate.mailto(string $email [, string $title [, $json ]]) }}
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
{{ craft.dsObfuscate.obfuscate('Some string to hide ' ~ foo.bar) }}
````

