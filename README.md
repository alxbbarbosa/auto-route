# AutoRoute DB
------------------------------------------------------------------------------

É uma lib para carregamento das rotas no Laravel apartir do banco de dados.

No momento está funcionando adequadamente para Postgres porque tem sido desenvolvido em um ambiente com Postgres. 
Mas foi implementado também para MySQL, embora ainda esteja em desenvolvimento, não testado por completo.

## Getting Started

Por enquanto ainda não está Packagist. Então a instalação não está sendo toda automatizada pelo composer.
Siga o passo-a-passo seguinte para fazer o processo manual.

### Prerequisites

PHP 7.x
Laravel 5.x

### Installing


Você pode fazer o clone deste código e salvar direto no diretório vendor. Os procedimentos abaixo estão contado que você deverá criar um diretório:

```

abbarbosa

```

Deverá fazer o clone deste projeto para este diretório. Uma estrutura semelhante a esta deverá existir:

(diretório do projeto)
          |
          |
        vendor
          |
          \--> abbarbosa
                 |
                 \--> auto-route
                        |
                        +--> migrations
                        |
                        +--> seeders
                        |
                        +--> src
                              |
                              \--> ... (demais arquivos do código)


Se tiver experiencia com composer, poderá salvar onde achar conveniente.

Visto que, o pacote não ainda está sendo instalado pelo composer, o trabalho deverá ser todo manual.
Você deverá adicionar ao composer.json as linhas, conforme a sessão abaixo:

```

"psr-4": {
            "App\\": "app/",

            "Abbarbosa\\infoDynamics\\AutoRoute\\Providers\\": "vendor/abbarbosa/auto-route/src/class/provider/",
            "Abbarbosa\\infoDynamics\\AutoRoute\\Services\\": "vendor/abbarbosa/auto-route/src/class/services/",
            "Abbarbosa\\infoDynamics\\AutoRoute\\Model\\": "vendor/abbarbosa/auto-route/src/class/model/",
            "Abbarbosa\\infoDynamics\\Contracts\\": "vendor/abbarbosa/auto-route/src/contracts/",
            "Abbarbosa\\infoDynamics\\AutoRoute\\Facade\\": "vendor/abbarbosa/auto-route/src/class/facade/"
        }
```

Note que as definições de caminho acima se referem a locais onde as classes foram salvas conforme a estapa anterior.
Feito isso, rote no terminal o comando:


```

composer dump-autoload

```

Se tudo estiver ok, nenhuma saída de erro será gerada. Caso ocorra algum erro, você deverá verificar se o caminho onde salvou o pacote, condiz com a configuração do composer.

Após isso, configure o arquivo config/app.php do Laravel, adicionando o provider (Note que parte do código foi omitido, deixando apenas as informações relevantes) 

```
   /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
   */
  'providers' => [
      /*
       * Laravel Framework Service Providers...
       */
       
       ...

      /*
       * Application Service Providers...
       */

       ...

       \Abbarbosa\infoDynamics\AutoRoute\Providers\AutoRouteDbServiceProvider::class,


```

e a Facade (Note que parte do código foi omitido, deixando apenas as informações relevantes):

```
  /*
   |--------------------------------------------------------------------------
   | Class Aliases
   |--------------------------------------------------------------------------
   |
   | This array of class aliases will be registered when this application
   | is started. However, feel free to register as many as you wish as
   | the aliases are "lazy" loaded so they don't hinder performance.
   |
  */
 'aliases' => [

    ...

    'autoRoute'=> \Abbarbosa\infoDynamics\AutoRoute\Model\Facade\AutoRoute::class,
  ],
];

```


A única linha que será necessário adicionar no arquivo web.php:

```

\Abbarbosa\infoDynamics\AutoRoute\Model\Facade\AutoRoute::register();

```

Para concluir a configuração, será necessário copiar a migração do diretório migration e incluir no diretório migration oficial do seu projeto.

Então após migrar, as configurações estarão concluídas.
Para ajudar a criar rotas, há um seeder explicando cada coluna, oque deverá e o que não deverá ser preenchido conforme a criação.

Feito isso pode salvar todas suas rotas no banco de dados e ignorar completamente as entradas de rotas no arquivo web.php.


## Authors

* **Alexandre Bezerra Barbosa** - *Initial work* - [Exemplos MVC](https://github.com/alxbbarbosa)

See also the list of [contributors](https://github.com/alxbbarbosa/auto-route-db/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

------------------------------------------------------------------------------
