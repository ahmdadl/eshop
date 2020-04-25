<?php

namespace App\Http\Controllers;

trait ApiDocsTrait
{
    public function docs()
    {
        $base = 'http://api.test';
        $d = new \stdClass;
        $arr = [
            $this->doc(
                $base,
                '/',
                'GET',
                'display current timestamp.',
                null,
                null,
                '"2020-04-24T12:13:46.896128Z"',
                [],
                [200, 'text contains current time stamp'],
                [],
                [],
                'Public'
            ),
            $this->doc(
                $base,
                '/inspire',
                'GET',
                'display an Inspiring Quote.',
                '/inspire',
                '/inspire',
                '"The only way to do great work is to love what you do. - Steve Jobs"',
                [],
                [200, 'text contains an inspiring quote.'],
            ),
            $this->doc(
                $base,
                '/category/base',
                'GET',
                'get categories displayed in navigation.',
                '/category/base',
                '/category/base',
                '[{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"},{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"},{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"},{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"},{"id":38,"name":"home","category_id":null,"slug":"home","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"},{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"},{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}]',
                [
                    $this->cparam('Authorization', 'A valid access token', true)
                ],
                [200, 'array contains category objects'],
                [],
                [],
                'Category'
            ),
            $this->doc(
                $base,
                '/category/sub/ids',
                'GET',
                'load sub categories ids',
                '/category/sub/ids',
                '/category/sub/ids',
                '[{"id":2},{"id":3},{"id":4},{"id":5},{"id":6},{"id":7},{"id":8},{"id":9},{"id":10},{"id":11},{"id":13},{"id":14},{"id":15},{"id":16},{"id":17},{"id":18},{"id":19},{"id":20},{"id":21},{"id":23},{"id":24},{"id":25},{"id":26},{"id":27},{"id":28},{"id":30},{"id":31},{"id":32},{"id":33},{"id":34},{"id":35},{"id":36},{"id":37},{"id":39},{"id":40},{"id":41},{"id":42},{"id":43},{"id":45},{"id":46},{"id":47},{"id":48},{"id":49},{"id":50},{"id":51},{"id":53},{"id":54},{"id":55},{"id":56},{"id":57},{"id":58},{"id":59},{"id":60}]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'array of sub category ids.'],
            ),
            $this->doc(
                $base,
                '/category/sub/list',
                'GET',
                'load sub categories list',
                '/category/sub/list',
                '/category/sub/list',
                '[{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":3,"name":"Quia repudiandae.","category_id":1,"slug":"quia-repudiandae","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":4,"name":"Vel non.","category_id":1,"slug":"vel-non","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":5,"name":"Itaque id.","category_id":1,"slug":"itaque-id","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":6,"name":"Ut tempore est.","category_id":1,"slug":"ut-tempore-est","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":7,"name":"Debitis non.","category_id":1,"slug":"debitis-non","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":8,"name":"Fuga dolore a.","category_id":1,"slug":"fuga-dolore-a","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":9,"name":"Eum aperiam.","category_id":1,"slug":"eum-aperiam","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":10,"name":"Repellat ratione.","category_id":1,"slug":"repellat-ratione","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":11,"name":"Unde vero.","category_id":1,"slug":"unde-vero","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":13,"name":"Tenetur magni nihil.","category_id":12,"slug":"tenetur-magni-nihil","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":14,"name":"Error commodi.","category_id":12,"slug":"error-commodi","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":15,"name":"Sed fugiat est.","category_id":12,"slug":"sed-fugiat-est","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":16,"name":"Id et laborum.","category_id":12,"slug":"id-et-laborum","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":17,"name":"Corrupti fugit voluptas.","category_id":12,"slug":"corrupti-fugit-voluptas","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":18,"name":"Consequatur sit rem.","category_id":12,"slug":"consequatur-sit-rem","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":19,"name":"Praesentium dolores dolorem.","category_id":12,"slug":"praesentium-dolores-dolorem","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":20,"name":"Et est.","category_id":12,"slug":"et-est","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":21,"name":"Alias eos quasi.","category_id":12,"slug":"alias-eos-quasi","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":12,"name":"super market","category_id":null,"slug":"super-market","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":23,"name":"At est.","category_id":22,"slug":"at-est","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":24,"name":"Error harum.","category_id":22,"slug":"error-harum","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":25,"name":"Qui fugit labore.","category_id":22,"slug":"qui-fugit-labore","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":26,"name":"Vero odio aut.","category_id":22,"slug":"vero-odio-aut","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":27,"name":"Est eaque ipsum.","category_id":22,"slug":"est-eaque-ipsum","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":28,"name":"Officiis nihil aliquam.","category_id":22,"slug":"officiis-nihil-aliquam","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":22,"name":"mobiles & tablets","category_id":null,"slug":"mobiles-tablets","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":30,"name":"Provident quod consequatur.","category_id":29,"slug":"provident-quod-consequatur","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":31,"name":"Possimus neque omnis.","category_id":29,"slug":"possimus-neque-omnis","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":32,"name":"Quam esse.","category_id":29,"slug":"quam-esse","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":33,"name":"Non tempora.","category_id":29,"slug":"non-tempora","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":34,"name":"Omnis quia quod.","category_id":29,"slug":"omnis-quia-quod","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":35,"name":"Dignissimos aut.","category_id":29,"slug":"dignissimos-aut","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":36,"name":"Ea est.","category_id":29,"slug":"ea-est","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":37,"name":"Iure officiis repellendus.","category_id":29,"slug":"iure-officiis-repellendus","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":29,"name":"electronics","category_id":null,"slug":"electronics","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":39,"name":"Ut alias sapiente.","category_id":38,"slug":"ut-alias-sapiente","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":38,"name":"home","category_id":null,"slug":"home","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":40,"name":"Et eveniet.","category_id":38,"slug":"et-eveniet","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":38,"name":"home","category_id":null,"slug":"home","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":41,"name":"Voluptatibus sed.","category_id":38,"slug":"voluptatibus-sed","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":38,"name":"home","category_id":null,"slug":"home","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":42,"name":"Quam ad.","category_id":38,"slug":"quam-ad","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":38,"name":"home","category_id":null,"slug":"home","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":43,"name":"Maiores ut.","category_id":38,"slug":"maiores-ut","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":38,"name":"home","category_id":null,"slug":"home","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":45,"name":"Enim ea nihil.","category_id":44,"slug":"enim-ea-nihil","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":46,"name":"Odit perspiciatis at.","category_id":44,"slug":"odit-perspiciatis-at","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":47,"name":"Sunt eum voluptatum.","category_id":44,"slug":"sunt-eum-voluptatum","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":48,"name":"Et molestias.","category_id":44,"slug":"et-molestias","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":49,"name":"Cupiditate reiciendis.","category_id":44,"slug":"cupiditate-reiciendis","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":50,"name":"Est debitis corporis.","category_id":44,"slug":"est-debitis-corporis","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":51,"name":"Non eveniet.","category_id":44,"slug":"non-eveniet","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":53,"name":"Autem odit nam.","category_id":52,"slug":"autem-odit-nam","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":54,"name":"Possimus nisi.","category_id":52,"slug":"possimus-nisi","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":55,"name":"Enim numquam.","category_id":52,"slug":"enim-numquam","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":56,"name":"Perspiciatis ut quia.","category_id":52,"slug":"perspiciatis-ut-quia","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":57,"name":"Architecto quae qui.","category_id":52,"slug":"architecto-quae-qui","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":58,"name":"Sit sit iure.","category_id":52,"slug":"sit-sit-iure","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":59,"name":"Maiores alias sit.","category_id":52,"slug":"maiores-alias-sit","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}},{"id":60,"name":"Corrupti laborum.","category_id":52,"slug":"corrupti-laborum","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":52,"name":"sports","category_id":null,"slug":"sports","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'array of sub category objects.'],
            ),
            $this->doc(
                $base,
                '/category/sub/{sub_category_slug}',
                'GET',
                'load one category info',
                '/category/sub/{sub_category_slug}',
                '/category/sub/sunt-eum-voluptatum',
                '[{"id":47,"name":"Sunt eum voluptatum.","category_id":44,"slug":"sunt-eum-voluptatum","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":44,"name":"toys","category_id":null,"slug":"toys","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'category object with refrences to parent category.'],
            ),
            $this->doc(
                $base,
                '/product/ids',
                'GET',
                'load list of products ids',
                '/product/ids/{count_per_page}',
                '/product/ids/10',
                '{"current_page":1,"data":[{"id":42},{"id":43},{"id":44},{"id":45},{"id":46},{"id":47},{"id":48},{"id":49},{"id":50},{"id":51}],"first_page_url":"http:\/\/api.test\/product\/ids\/10?page=1","from":1,"last_page":420,"last_page_url":"http:\/\/api.test\/product\/ids\/10?page=420","next_page_url":"http:\/\/api.test\/product\/ids\/10?page=2","path":"http:\/\/api.test\/product\/ids\/10","per_page":10,"prev_page_url":null,"to":10,"total":4197}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products ids.'],
                [$this->cparam('Count Per Page', 'how many ids to load per one page', false, 70)],
                [],
                'Product'
            ),
            $this->doc(
                $base,
                '/product/list',
                'GET',
                'load list of products list',
                '/product/list/{count_per_page}',
                '/product/list/2',
                '{"current_page":1,"data":[{"id":1,"user_id":4,"category_slug":"et-praesentium-in","name":"Consequatur quibusdam rem consequuntur sunt provident dolores.","price":23350.3,"save":84,"amount":4,"is_used":true,"brand":"Balistreri LLC","color":["ForestGreen","Pink"],"img":["15.jpg","4.jpg","7.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Harum iste quae officia repudiandae. Quo itaque pariatur quia dolorum odio. Amet est ipsum quia dolorem magni odit a.","slug":"consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores","savedPrice":3736.047999999999},{"id":2,"user_id":5,"category_slug":"et-praesentium-in","name":"Assumenda nemo voluptatum nemo fuga illum voluptas.","price":14321.4,"save":71,"amount":11,"is_used":false,"brand":"Koss Group","color":["PapayaWhip","NavajoWhite"],"img":["1.jpg","2.jpg","15.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Dolorum exercitationem est voluptatem sed similique. Eligendi libero culpa ducimus. Quas accusantium et sapiente in asperiores voluptatem.","slug":"assumenda-nemo-voluptatum-nemo-fuga-illum-voluptas","savedPrice":4153.206}],"first_page_url":"http:\/\/api.test\/product\/list\/2?page=1","from":1,"last_page":2099,"last_page_url":"http:\/\/api.test\/product\/list\/2?page=2099","next_page_url":"http:\/\/api.test\/product\/list\/2?page=2","path":"http:\/\/api.test\/product\/list\/2","per_page":2,"prev_page_url":null,"to":2,"total":4197}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products objects.'],
                [$this->cparam('Count Per Page', 'how many products to load per one page', false, 70)]
            ),
            $this->doc(
                $base,
                '/product/find?q=search',
                'GET',
                'search for products with name or brand',
                '/product/find/{count_per_page}?q={query}',
                '/product/find/2?q=Consequatu',
                '{"current_page":1,"data":[{"id":4224,"user_id":4228,"category_slug":null,"name":"Sunt corrupti aut molestias consequatur voluptas vero in totam.","price":76330.2,"save":38,"amount":10,"is_used":false,"brand":"another company","color":["Navy","PowderBlue"],"img":["4.jpg","8.jpg","3.jpg"],"created_at":"2020-04-23T15:24:10.000000Z","updated_at":"2020-04-23T15:24:10.000000Z","info":"Blanditiis dolores eaque maiores aut voluptates fuga quia. Aut necessitatibus qui qui neque ratione corrupti. Sed ea eos vel vel provident nemo.","slug":"sunt-corrupti-aut-molestias-consequatur-voluptas-vero-in-totam","savedPrice":47324.724,"rates":[{"id":39443,"user_id":4,"product_id":4224,"rate":"1","message":"some words combined","created_at":"2020-04-23T15:24:10.000000Z","updated_at":"2020-04-23T15:24:10.000000Z","updated":"21 hours ago"}],"p_cat":null},{"id":4223,"user_id":4227,"category_slug":null,"name":"Velit nam possimus dolores illo consequatur nesciunt corrupti voluptas.","price":59490.8,"save":67,"amount":4,"is_used":true,"brand":"another company","color":["WhiteSmoke","SandyBrown"],"img":["4.jpg","12.jpg","1.jpg"],"created_at":"2020-04-23T15:23:33.000000Z","updated_at":"2020-04-23T15:23:33.000000Z","info":"Nostrum repellat consequatur reiciendis eaque. Perferendis esse modi et dolorem quia. Dolor tenetur sequi et sit illum officiis. Harum sint quia et est.","slug":"velit-nam-possimus-dolores-illo-consequatur-nesciunt-corrupti-voluptas","savedPrice":19631.964,"rates":[{"id":39442,"user_id":4,"product_id":4223,"rate":"2","message":"some words combined","created_at":"2020-04-23T15:23:33.000000Z","updated_at":"2020-04-23T15:23:33.000000Z","updated":"21 hours ago"}],"p_cat":null}],"first_page_url":"http:\/\/api.test\/product\/find\/2?page=1","from":1,"last_page":168,"last_page_url":"http:\/\/api.test\/product\/find\/2?page=168","next_page_url":"http:\/\/api.test\/product\/find\/2?page=2","path":"http:\/\/api.test\/product\/find\/2","per_page":2,"prev_page_url":null,"to":2,"total":336}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of found products.'],
                [$this->cparam('Count Per Page', 'how many products to load per one page', false, 70)],
                [$this->cparam('q', 'product name or brand', true)]
            ),
            $this->doc(
                $base,
                '/product/sub/{slug}',
                'GET',
                'load products with category slug',
                '/product/sub/{slug}/{count_per_page}',
                '/product/sub/et-praesentium-in/2',
                '{"current_page":1,"data":[{"id":1,"user_id":4,"category_slug":"et-praesentium-in","name":"Consequatur quibusdam rem consequuntur sunt provident dolores.","price":23350.3,"save":84,"amount":4,"is_used":true,"brand":"Balistreri LLC","color":["ForestGreen","Pink"],"img":["15.jpg","4.jpg","7.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Harum iste quae officia repudiandae. Quo itaque pariatur quia dolorum odio. Amet est ipsum quia dolorem magni odit a.","slug":"consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores","savedPrice":3736.047999999999},{"id":2,"user_id":5,"category_slug":"et-praesentium-in","name":"Assumenda nemo voluptatum nemo fuga illum voluptas.","price":14321.4,"save":71,"amount":11,"is_used":false,"brand":"Koss Group","color":["PapayaWhip","NavajoWhite"],"img":["1.jpg","2.jpg","15.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Dolorum exercitationem est voluptatem sed similique. Eligendi libero culpa ducimus. Quas accusantium et sapiente in asperiores voluptatem.","slug":"assumenda-nemo-voluptatum-nemo-fuga-illum-voluptas","savedPrice":4153.206}],"first_page_url":"http:\/\/api.test\/product\/sub\/et-praesentium-in\/2?page=1","from":1,"last_page":29,"last_page_url":"http:\/\/api.test\/product\/sub\/et-praesentium-in\/2?page=29","next_page_url":"http:\/\/api.test\/product\/sub\/et-praesentium-in\/2?page=2","path":"http:\/\/api.test\/product\/sub\/et-praesentium-in\/2","per_page":2,"prev_page_url":null,"to":2,"total":57}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products.'],
                [
                    $this->cparam('slug', 'sub category slug', true), $this->cparam('Count Per Page', 'how many products to load per one page', false, 70)
                ]
            ),
            $this->doc(
                $base,
                '/product/collect/{ids}',
                'GET',
                'load products with ids',
                '/product/collect/{ids}',
                '/product/collect/2,5',
                '[{"id":3,"user_id":6,"category_slug":"et-praesentium-in","name":"Autem pariatur fugit et vitae.","price":72769.3,"save":56,"amount":21,"is_used":false,"brand":"Mosciski and Sons","color":["DarkGreen","PeachPuff"],"img":["14.jpg","5.jpg","4.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Sunt suscipit ab ad natus. Pariatur consectetur nam omnis similique. Quibusdam modi voluptas et accusantium.","slug":"autem-pariatur-fugit-et-vitae","savedPrice":32018.492},{"id":5,"user_id":8,"category_slug":"et-praesentium-in","name":"Ullam hic reprehenderit reiciendis at fugiat rerum architecto.","price":80932.7,"save":34,"amount":24,"is_used":false,"brand":"Balistreri LLC","color":["AntiqueWhite","PaleVioletRed"],"img":["7.jpg","12.jpg","2.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Hic qui voluptatibus veritatis. In in explicabo sint. Maiores error accusantium aliquam exercitationem voluptas.","slug":"ullam-hic-reprehenderit-reiciendis-at-fugiat-rerum-architecto","savedPrice":53415.581999999995}]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products.'],
                [$this->cparam('ids', 'list of products id seperated by comma', false, 70)]
            ),
            $this->doc(
                $base,
                '/product/filter/sub/{slug}/brands/{brands}',
                'GET',
                'filter products with brands',
                '/product/filter/sub/{slug}/brands/{brands}/{count per page}',
                '/product/filter/sub/et-praesentium-in/brands/Monahan-Kilback,Hoeger Group/2',
                '{"current_page":1,"data":[{"id":16,"user_id":19,"category_slug":"et-praesentium-in","name":"Error voluptatem dolore dolorum deserunt.","price":77092,"save":69,"amount":17,"is_used":true,"brand":"Monahan-Kilback","color":["Chartreuse","SkyBlue"],"img":["11.jpg","15.jpg","10.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Qui qui mollitia voluptates est beatae similique ex. Sapiente alias veniam nemo. Vel libero iste asperiores libero. Omnis provident qui doloribus ab velit consequatur.","slug":"error-voluptatem-dolore-dolorum-deserunt","savedPrice":23898.520000000004,"p_cat":{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}},{"id":23,"user_id":26,"category_slug":"et-praesentium-in","name":"Repudiandae quo cumque iusto facere non recusandae debitis.","price":36084.6,"save":92,"amount":5,"is_used":true,"brand":"Monahan-Kilback","color":["Salmon","SaddleBrown"],"img":["8.jpg","2.jpg","7.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Sapiente porro quaerat beatae et. Id temporibus sed reiciendis temporibus. Placeat ab officia ut eaque.","slug":"repudiandae-quo-cumque-iusto-facere-non-recusandae-debitis","savedPrice":2886.7679999999964,"p_cat":{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}}],"first_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/brands\/Monahan-Kilback,Hoeger%20Group\/2?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/brands\/Monahan-Kilback,Hoeger%20Group\/2?page=1","next_page_url":null,"path":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/brands\/Monahan-Kilback,Hoeger%20Group\/2","per_page":2,"prev_page_url":null,"to":2,"total":2}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products.'],
                [
                    $this->cparam('slug', 'sub category slug', true),
                    $this->cparam('brands', 'list of brands seperated with comma', true),
                    $this->cparam('count per page', 'number of results to load per page')
                ]
            ),
            $this->doc(
                $base,
                '/product/filter/sub/{slug}/condition/{condition}',
                'GET',
                'filter products with condition',
                '/product/filter/sub/{slug}/condition/{condition}/{count per page}',
                '/product/filter/sub/et-praesentium-in/condition/0/2',
                '{"current_page":1,"data":[{"id":2,"user_id":5,"category_slug":"et-praesentium-in","name":"Assumenda nemo voluptatum nemo fuga illum voluptas.","price":14321.4,"save":71,"amount":11,"is_used":false,"brand":"Koss Group","color":["PapayaWhip","NavajoWhite"],"img":["1.jpg","2.jpg","15.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Dolorum exercitationem est voluptatem sed similique. Eligendi libero culpa ducimus. Quas accusantium et sapiente in asperiores voluptatem.","slug":"assumenda-nemo-voluptatum-nemo-fuga-illum-voluptas","savedPrice":4153.206,"p_cat":{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}},{"id":3,"user_id":6,"category_slug":"et-praesentium-in","name":"Autem pariatur fugit et vitae.","price":72769.3,"save":56,"amount":21,"is_used":false,"brand":"Mosciski and Sons","color":["DarkGreen","PeachPuff"],"img":["14.jpg","5.jpg","4.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Sunt suscipit ab ad natus. Pariatur consectetur nam omnis similique. Quibusdam modi voluptas et accusantium.","slug":"autem-pariatur-fugit-et-vitae","savedPrice":32018.492,"p_cat":{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}}],"first_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/condition\/0\/2?page=1","from":1,"last_page":19,"last_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/condition\/0\/2?page=19","next_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/condition\/0\/2?page=2","path":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/condition\/0\/2","per_page":2,"prev_page_url":null,"to":2,"total":37}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products.'],
                [
                    $this->cparam('slug', 'sub category slug', true),
                    $this->cparam('condition', 'product condition (0 -> used products, 1 -> new products)', true),
                    $this->cparam('count per page', 'number of results to load per page')
                ]
            ),
            $this->doc(
                $base,
                '/product/filter/sub/{slug}/price/{prices}',
                'GET',
                'filter products with price',
                '/product/filter/sub/{slug}/price/{prices}/{count per page}',
                '/product/filter/sub/et-praesentium-in/price/1000,3000/2',
                '{"current_page":1,"data":[{"id":6,"user_id":9,"category_slug":"et-praesentium-in","name":"Reprehenderit aliquid architecto eveniet labore sed omnis et.","price":6780.3,"save":70,"amount":10,"is_used":false,"brand":"Kshlerin-Rosenbaum","color":["DarkMagenta","Navy"],"img":["10.jpg","13.jpg","1.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Sapiente et ut veritatis sed adipisci quo voluptas modi. Velit fugiat qui officiis ducimus. Quae alias ex ex.","slug":"reprehenderit-aliquid-architecto-eveniet-labore-sed-omnis-et","savedPrice":2034.0900000000001,"p_cat":{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}},{"id":22,"user_id":25,"category_slug":"et-praesentium-in","name":"Magni porro dolorem aspernatur ut.","price":3561.9,"save":25,"amount":25,"is_used":true,"brand":"Reilly Hintz and Ernser","color":["AliceBlue","DarkOliveGreen"],"img":["7.jpg","7.jpg","13.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Unde eum non ut asperiores. Dolor dolor aut expedita qui sit est et qui. Illo ad dolorum minus.","slug":"magni-porro-dolorem-aspernatur-ut","savedPrice":2671.425,"p_cat":{"id":2,"name":"Et praesentium in.","category_id":1,"slug":"et-praesentium-in","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}}],"first_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/price\/1000,3000\/2?page=1","from":1,"last_page":3,"last_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/price\/1000,3000\/2?page=3","next_page_url":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/price\/1000,3000\/2?page=2","path":"http:\/\/api.test\/product\/filter\/sub\/et-praesentium-in\/price\/1000,3000\/2","per_page":2,"prev_page_url":null,"to":2,"total":5}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object contains pagination urls and array of products.'],
                [
                    $this->cparam('slug', 'sub category slug', true),
                    $this->cparam('prices', 'mininum and maximum price seprated with comma', true),
                    $this->cparam('count per page', 'number of results to load per page')
                ]
            ),
            $this->doc(
                $base,
                '/product/{slug}',
                'GET',
                'load product with all rates',
                '/product/{slug}',
                '/product/assumenda-nemo-voluptatum-nemo-fuga-illum-voluptas',
                '[{"id":2,"user_id":5,"category_slug":"et-praesentium-in","name":"Assumenda nemo voluptatum nemo fuga illum voluptas.","price":14321.4,"save":71,"amount":11,"is_used":false,"brand":"Koss Group","color":["PapayaWhip","NavajoWhite"],"img":["1.jpg","2.jpg","15.jpg"],"created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","info":"Dolorum exercitationem est voluptatem sed similique. Eligendi libero culpa ducimus. Quas accusantium et sapiente in asperiores voluptatem.","slug":"assumenda-nemo-voluptatum-nemo-fuga-illum-voluptas","savedPrice":4153.206,"rates":[{"id":11,"user_id":1188,"product_id":2,"rate":"2","message":"Voluptates fuga ut ut ut eius perspiciatis. Provident in cupiditate tempore aperiam. Et est et culpa odit. Deserunt explicabo a quia eum corporis adipisci sed.","created_at":null,"updated_at":"2020-04-18T16:11:08.000000Z","updated":"5 days ago"},{"id":12,"user_id":2111,"product_id":2,"rate":"1","message":"Reiciendis temporibus et velit autem. Maiores nam maiores labore consequatur accusantium. Repudiandae perferendis praesentium praesentium. Voluptates delectus est ab ipsum.","created_at":null,"updated_at":"2020-04-23T00:45:30.000000Z","updated":"1 day ago"},{"id":13,"user_id":891,"product_id":2,"rate":"0","message":"Earum quasi eos omnis a dolor. Qui ut enim quia placeat. Doloribus ex molestiae quas ratione voluptate vitae et magni. Modi delectus voluptatem neque ut ut iste.","created_at":null,"updated_at":"2020-03-27T17:39:07.000000Z","updated":"3 weeks ago"},{"id":14,"user_id":191,"product_id":2,"rate":"3","message":"Nam quo dolorum eum qui excepturi consectetur iure. Iusto labore sequi hic aut quisquam ut provident quam. Fugiat esse architecto ut similique quo sit.","created_at":null,"updated_at":"2020-04-08T21:43:10.000000Z","updated":"2 weeks ago"},{"id":15,"user_id":1340,"product_id":2,"rate":"0","message":"Aut sint non aperiam praesentium sint velit. Vel qui sit nemo qui excepturi ut ut. Et laborum et dolorem eius consequatur. Eveniet ut cumque porro qui est impedit. Officia facilis cum eaque tempore et a.","created_at":null,"updated_at":"2020-03-26T12:15:35.000000Z","updated":"4 weeks ago"},{"id":16,"user_id":359,"product_id":2,"rate":"1","message":"Ad praesentium odio explicabo at. Error praesentium laborum officiis ab dolorum quam autem. Commodi dolorem qui voluptates sit consequatur dolorum. Veniam asperiores voluptate non voluptatum sunt.","created_at":null,"updated_at":"2020-04-09T21:00:29.000000Z","updated":"2 weeks ago"},{"id":17,"user_id":3826,"product_id":2,"rate":"2","message":"Dolorem sapiente cupiditate vel ut rem in. Eligendi veniam molestias ducimus quam. Molestiae et consequuntur necessitatibus rem consectetur. Nihil quidem tempore excepturi inventore aliquid est.","created_at":null,"updated_at":"2020-03-29T05:20:39.000000Z","updated":"3 weeks ago"},{"id":18,"user_id":544,"product_id":2,"rate":"0","message":"Sed numquam et necessitatibus nisi aliquid tempore. Dignissimos consequatur occaecati assumenda numquam eos et quisquam non. Vero consequatur sed debitis illo labore optio.","created_at":null,"updated_at":"2020-04-18T03:17:47.000000Z","updated":"6 days ago"},{"id":19,"user_id":2900,"product_id":2,"rate":"4","message":"Eveniet qui eveniet hic laudantium sit quasi beatae. Molestias quasi quae possimus sint vitae est harum dolor. Aliquam mollitia soluta labore dolorem soluta officia est. Temporibus commodi nihil alias fugiat odio qui quo.","created_at":null,"updated_at":"2020-04-20T15:07:30.000000Z","updated":"3 days ago"},{"id":20,"user_id":3437,"product_id":2,"rate":"2","message":"Mollitia qui laborum ab et cum. Illum accusantium sed autem delectus repellat pariatur. Quos aliquam vel est minima enim deserunt. Laudantium est eum aperiam voluptate doloribus. Blanditiis eum rerum est est et. Unde sit veniam ipsum qui placeat.","created_at":null,"updated_at":"2020-04-14T00:29:33.000000Z","updated":"1 week ago"},{"id":21,"user_id":3492,"product_id":2,"rate":"1","message":"Officia at velit tempore consequuntur voluptatem nostrum quaerat. Sit nostrum enim commodi atque. Illum suscipit laudantium at non ut fugiat. Repudiandae earum optio rerum a et natus.","created_at":null,"updated_at":"2020-04-06T20:38:24.000000Z","updated":"2 weeks ago"}]}]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'product object with array of rates.'],
                [$this->cparam('slug', 'product slug', true)]
            ),
            $this->doc(
                $base,
                '/product',
                'POST',
                'store new product',
                '/product?category=&name=&brand=&info=&price=&amount=&save=&color=',
                '/product?category=47&name=my product&brand=my company&info=some text lorem lorem lorem lorem&price=3650.25&amount=36&save=40&color=red,white,black,gold',
                '{"name":"my product","brand":"my company","info":"some text lorem lorem lorem lorem","price":"3650.25","amount":"36","save":"40","color":["red","white","black","gold"],"user_id":3,"category_slug":"sunt-eum-voluptatum","is_used":true,"img":["15.jpg","13.jpg","12.jpg"],"slug":"my-product","updated_at":"2020-04-24T14:31:15.000000Z","created_at":"2020-04-24T14:31:15.000000Z","id":4251,"savedPrice":2190.1499999999996}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [201, 'newly stored product object.'],
                [],
                [
                    $this->cparam('category', 'sub category id', true),
                    $this->cparam('name', 'product name', true),
                    $this->cparam('brand', 'product brand', true),
                    $this->cparam('info', 'product description - minimum 10 characters', true),
                    $this->cparam('price', 'product price - minimum $1', true),
                    $this->cparam('amount', 'product stock amount - minimum 1 item', true),
                    $this->cparam('save', 'product save percentage - minimum 0, maximum 100', true),
                    $this->cparam('color', 'product colors - list of colors seperated with comma', true),
                    $this->cparam('is_used', 'is product condition is used', false, false)
                ]
            ),
            $this->doc(
                $base,
                '/product/{slug}/patch',
                'POST',
                'update product - requires ownership or admin/super user access',
                '/product/{slug}/patch?name=&brand=&info=&price=&amount=&save=&color=',
                '/product/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores/patch?name=consequatur quibusdam rem consequuntur&brand=my company&info=some text lorem lorem lorem lorem&price=3650.25&amount=36&save=40&color=red,white,black,gold',
                '[]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [204, '.'],
                [$this->cparam('slug', 'product slug', true)],
                [
                    $this->cparam('name', 'product name', true),
                    $this->cparam('brand', 'product brand', true),
                    $this->cparam('info', 'product description - minimum 10 characters', true),
                    $this->cparam('price', 'product price - minimum $1', true),
                    $this->cparam('amount', 'product stock amount - minimum 1 item', true),
                    $this->cparam('save', 'product save percentage - minimum 0, maximum 100', true),
                    $this->cparam('color', 'product colors - list of colors seperated with comma', true),
                    $this->cparam('is_used', 'is product condition is used', false, false)
                ]
            ),
            $this->doc(
                $base,
                '/product/{slug}/delete',
                'POST',
                'update product - requires ownership or admin user access',
                '/product/{slug}/delete',
                '/product/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores/delete',
                '[]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [204, '.'],
                [$this->cparam('slug', 'product slug', true)]
            ),
            // rates
            $this->doc(
                $base,
                '/product/{slug}/rates/{count per page}',
                'GET',
                'load all product',
                '/product/{slug}/rates',
                '/product/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores/rates/3',
                '{"current_page":1,"data":[{"id":1,"user_id":1277,"product_id":1,"rate":"1","message":"Occaecati quidem delectus maxime voluptates. Maiores est suscipit dolore voluptatem doloribus provident. Nobis consequatur hic minus voluptas molestiae officiis repellat. Nisi et autem sit architecto omnis et non.","created_at":null,"updated_at":"2020-03-28T13:24:14.000000Z","updated":"3 weeks ago"},{"id":2,"user_id":2295,"product_id":1,"rate":"3","message":"Suscipit harum laborum consequuntur debitis. Fugit inventore doloribus quidem. Praesentium et impedit porro velit ut blanditiis velit quaerat.","created_at":null,"updated_at":"2020-04-08T07:20:25.000000Z","updated":"2 weeks ago"},{"id":3,"user_id":2490,"product_id":1,"rate":"0","message":"Labore et et voluptas expedita consequatur. At nulla tempore ut iste quam. Sunt aut amet consectetur unde. Sunt praesentium ratione deserunt rerum. Dolorem sunt autem voluptatem at.","created_at":null,"updated_at":"2020-04-19T01:57:24.000000Z","updated":"5 days ago"}],"first_page_url":"http:\/\/api.test\/product\/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores\/rates\/3?page=1","from":1,"last_page":4,"last_page_url":"http:\/\/api.test\/product\/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores\/rates\/3?page=4","next_page_url":"http:\/\/api.test\/product\/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores\/rates\/3?page=2","path":"http:\/\/api.test\/product\/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores\/rates\/3","per_page":3,"prev_page_url":null,"to":3,"total":10}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'pagination object with rates list.'],
                [
                    $this->cparam('slug', 'product slug', true),
                    $this->cparam('count per page', 'how many results per page')
                ]
            ),
            $this->doc(
                $base,
                '/product/{slug}/rates',
                'POST',
                'rate product - can be called once - user cannot rate owned products',
                '/product/{slug}/rates',
                '/product/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores/rates?rate=1.9&message=some message lorem lorem lorem',
                '{"user_id":3,"rate":"1.9","message":"some message lorem lorem lorem","product_id":1,"updated_at":"2020-04-24T14:53:50.000000Z","created_at":"2020-04-24T14:53:50.000000Z","id":39449,"updated":"1 second ago"}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'newly saved rate object.'],
                [$this->cparam('slug', 'product slug', true)],
                [
                    $this->cparam('rate', 'how many starts to give - minimum=0 and maximum=5 - float', true),
                    $this->cparam('message', 'review message - miximum charcters 196', false)
                ]
            ),
            $this->doc(
                $base,
                '/product/{slug}/rates/{id}',
                'POST',
                'update rate - requires ownership',
                '/product/{slug}/rates/{id}',
                '/product/consequatur-quibusdam-rem-consequuntur-sunt-provident-dolores/rates/39449?rate=4.6',
                '[]',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [204, ''],
                [
                    $this->cparam('slug', 'product slug', true),
                    $this->cparam('id', 'rate id', true)
                ],
                [
                    $this->cparam('rate', 'how many starts to give - minimum=0 and maximum=5 - float', true),
                    $this->cparam('message', 'review message - miximum charcters 196', false)
                ]
            ),
            // user
            $this->doc(
                $base,
                '/user/list/{count per page}',
                'GET',
                'load users list - requires admin user access',
                '/user/list/{count per page}',
                '/user/list/2',
                '{"current_page":1,"data":[{"id":1,"name":"Sabryna Mills","email":"admin@site.test","email_verified_at":"2020-04-23 04:20:27","remember_token":"YSxopfrZrJ","created_at":"2020-04-23T04:20:27.000000Z","updated_at":"2020-04-23T04:20:27.000000Z","role":2},{"id":2,"name":"Leonardo Feil II","email":"super@site.test","email_verified_at":"2020-04-23 04:20:27","remember_token":"5BaQfSf1mhDMMo8yGGU3lVogaCtd9YFxE5TlUyqYFMvwChwwFr0aXr5NLOb6","created_at":"2020-04-23T04:20:27.000000Z","updated_at":"2020-04-23T04:20:27.000000Z","role":1}],"first_page_url":"http:\/\/api.test\/user\/list\/2?page=1","from":1,"last_page":2102,"last_page_url":"http:\/\/api.test\/user\/list\/2?page=2102","next_page_url":"http:\/\/api.test\/user\/list\/2?page=2","path":"http:\/\/api.test\/user\/list\/2","per_page":2,"prev_page_url":null,"to":2,"total":4203}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'pagination object with users list.'],
                [$this->cparam('count per page', 'number of users to load per page', true)],
                [],
                'User'
            ),
            $this->doc(
                $base,
                '/user/ids/{count per page}',
                'GET',
                'load users ids - requires admin user access',
                '/user/ids/{count per page}',
                '/user/ids/10',
                '{"current_page":1,"data":[{"id":331},{"id":3085},{"id":3404},{"id":3370},{"id":456},{"id":3865},{"id":3693},{"id":1549},{"id":3506},{"id":1557}],"first_page_url":"http:\/\/api.test\/user\/ids\/10?page=1","from":1,"last_page":421,"last_page_url":"http:\/\/api.test\/user\/ids\/10?page=421","next_page_url":"http:\/\/api.test\/user\/ids\/10?page=2","path":"http:\/\/api.test\/user\/ids\/10","per_page":10,"prev_page_url":null,"to":10,"total":4203}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'pagination object with users ids.'],
                [$this->cparam('count per page', 'number of users to load per page', true)]
            ),
            $this->doc(
                $base,
                '/user/profile/{id}',
                'GET',
                'load user stats - only admin can load any user profile - normal user can load owned stats',
                '/user/profile/{id}',
                '/user/profile',
                '{"orders_count":0,"delivered_orders":0,"proudcts_count":1357,"total_user_payment":0}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'object with user stats.'],
                [$this->cparam('id', 'load profile for user with this id', false)]
            ),
            $this->doc(
                $base,
                '/user/orders/{id}',
                'GET',
                'load user orders - only admin/super can load any user orders - normal user can load owned orders',
                '/user/orders/{id}',
                '/user/orders/3?perPage=1',
                '{"current_page":1,"data":[{"id":9,"user_id":3,"product_id":57,"address":"2732 Connelly Keys Suite 758Yostburgh, WA 46872-2314","amount":4,"total":58551.92,"sent":0,"created_at":"2020-04-24T13:25:37.000000Z","updated_at":"2020-04-24T13:25:37.000000Z","product":{"id":57,"user_id":60,"category_slug":"quia-repudiandae","name":"Illum ea est reiciendis omnis.","price":30495.8,"save":52,"amount":19,"is_used":false,"brand":"Sporer LLC","color":["Navy","LightCyan"],"img":["10.jpg","5.jpg","7.jpg"],"created_at":"2020-04-23T04:20:29.000000Z","updated_at":"2020-04-24T13:25:37.000000Z","info":"Sit ea accusantium dolores non. Voluptas sapiente voluptatem id sit. Et odit earum explicabo fugit cupiditate dolorum tempore.","slug":"illum-ea-est-reiciendis-omnis","savedPrice":14637.983999999999,"p_cat":{"id":3,"name":"Quia repudiandae.","category_id":1,"slug":"quia-repudiandae","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z","parent":{"id":1,"name":"fashion","category_id":null,"slug":"fashion","created_at":"2020-04-23T04:20:28.000000Z","updated_at":"2020-04-23T04:20:28.000000Z"}}}}],"first_page_url":"http:\/\/api.test\/user\/orders\/3?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/api.test\/user\/orders\/3?page=1","next_page_url":null,"path":"http:\/\/api.test\/user\/orders\/3","per_page":"1","prev_page_url":null,"to":1,"total":1}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'pagination object with user orders.'],
                [$this->cparam('id', 'load orders for user with this id', false)],
                [$this->cparam('perPage', 'number of orders to be loaded per one page')]
            ),
            $this->doc(
                $base,
                '/user/products/{id}',
                'GET',
                'load user products',
                '/user/products/{id}',
                '/user/products/3?perPage=2',
                '{"current_page":1,"data":[{"id":42,"user_id":3,"category_slug":"et-praesentium-in","name":"Et atque numquam quisquam eveniet maiores.","price":7765.1,"save":54,"amount":14,"is_used":false,"brand":"Hegmann-Sipes","color":["DarkKhaki","DodgerBlue"],"img":["9.jpg","15.jpg","10.jpg"],"created_at":"2020-04-23T04:20:29.000000Z","updated_at":"2020-04-23T04:20:29.000000Z","info":"Ullam natus laborum quibusdam ab amet reprehenderit sint. Ut dolorum necessitatibus et consequatur qui. Qui eos unde asperiores ullam adipisci.","slug":"et-atque-numquam-quisquam-eveniet-maiores","savedPrice":3571.946},{"id":43,"user_id":3,"category_slug":"et-praesentium-in","name":"Ducimus maxime vero omnis sequi voluptas est.","price":36236.6,"save":14,"amount":23,"is_used":true,"brand":"Stroman Ltd","color":["WhiteSmoke","MidnightBlue"],"img":["13.jpg","6.jpg","11.jpg"],"created_at":"2020-04-23T04:20:29.000000Z","updated_at":"2020-04-23T04:20:29.000000Z","info":"Porro voluptate ea quia fuga animi delectus maxime. Quasi est asperiores qui saepe.","slug":"ducimus-maxime-vero-omnis-sequi-voluptas-est","savedPrice":31163.476}],"first_page_url":"http:\/\/api.test\/user\/products\/3?page=1","from":1,"last_page":679,"last_page_url":"http:\/\/api.test\/user\/products\/3?page=679","next_page_url":"http:\/\/api.test\/user\/products\/3?page=2","path":"http:\/\/api.test\/user\/products\/3","per_page":"2","prev_page_url":null,"to":2,"total":1357}',
                [$this->cparam('Authorization', 'A valid access token', true)],
                [200, 'pagination object with user products.'],
                [$this->cparam('id', 'load products for user with this id', false)],
                [$this->cparam('perPage', 'number of products to be loaded per one page')]
            ),
            $this->doc(
                $base,
                '/user/{id}/role/patch',
                'POST',
                'change user role - requires admin access',
                '/user/{id}/role/patch?role=',
                '/user/5/role/patch?role=1',
                '',
                [$this->cparam('Authorization', 'A valid access token', true), $this->cparam('scopes', 'patch-role is required to access this route', true)],
                [204, ''],
                [$this->cparam('id', 'update this user role', false)],
                [$this->cparam('role', 'number, 0 -> normal user, 1 -> super user', false, 0)]
            ),
        ];

        file_put_contents(
            storage_path() . '/app/api_docs.php',
            serialize($arr)
        );
    }

    /**
     * Undocumented function
     *
     * @param string $base
     * @param string $route
     * @param string $method
     * @param string $info
     * @param string|null $urlWithParams
     * @param string|null $testCurl
     * @param string $response
     * @param array $headers
     * @param array $responseDoc
     * @param array|null $urlParams
     * @param array|null $query
     * @param string|null $parent
     * @return object
     */
    private function doc(
        string $base,
        string $route,
        string $method,
        string $info,
        ?string $urlWithParams,
        ?string $testCurl,
        string $response,
        array $headers,
        array $responseDoc,
        ?array $urlParams = [],
        ?array $query = [],
        ?string $parent = null
    ): object {
        $d = new \stdClass;
        $d->route = $route;
        $d->method = $method;
        $d->info = $info;
        $d->url_with_params = $base . $urlWithParams ?? $base  . $route;
        $d->test_curl = "curl " . $base . $testCurl ?? "curl " . $base . $route;
        if (sizeof($headers)) {
            $d->test_curl .= ' -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMWFlNWQ0ZDA4MWFjMTAwYmE0NzYyMTMzOTJiYTUwNjNlZTcwNDBkZWNlNDA0NDc3NWRiOGZmMTUxNDIzYjlmYTVhNWMzMDFkNGJjMTA3NjEiLCJpYXQiOjE1ODc3MTc2ODIsIm5iZiI6MTU4NzcxNzY4MiwiZXhwIjoxNTg3ODA0MDgyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.pQu9cPO6peRqmU3Kk25B_y1W5y4k2ujlOeE05_cWf30gDEat4iVSUIe8UmIV8KFmp259UO9rLqQAOLrSwMdWEm4X64SCiTD4ht5U0IE4MQt2Hb8AOnmhzO4cqpBYkX9BiyDJEKzQsir154Jfv71Qy4GCPrOYDMCcI7K6-40aO8yqw_hyQoZ1cZm2fnIPOVvcXP3Cna7jKIDq6YONKW8Cs_TMfFtW323KnIxNUoXFMHWVxkYI334nHs_a1GZberoU1VqxUEyzoz7BhGPlU83YW1dDVzWhzz7SCz-QZ4Z0H_GDpBsSi9VX6QldU7w9wa1XaMvS595-F2WbcVVDVEpTADjbifQ5B_yG7z_5MXINkOIVxXaKQv5Ngqx-tqQsG6itPOMi2GLLbWgdhckLNzWSF8PeAKi2zz5g_a795GICMA2tzAR1tXmIqjZlsCVfY_7AAss9-B5zOvW3xWfK5YLuIGcf5rWCWil20A5S0W7omtt_WKSw5337yLZI5XneVgkkKXMKef3GiWcbysBtDVJXbUxETj_VLQr9ZRJPxjMYzye6R59s3dOvP0fpk-U1SbSPr8p3-yO451xKIVcxpsD7cSbGMQagggq0tlcyAb53MCAhX3u53g9zw_ewxse0oLgaxmcJGN9fWL5HYqopawLcK70NSsMS75qKbszBLS6k89c" -H "Accept: application/json"';
        }
        $d->response = $response;
        $d->headers = $headers;
        $d->res_doc = $responseDoc;
        $d->url_params = $urlParams;
        $d->query = $query;
        $d->parent = $parent;
        return $d;
    }

    private function cparam(
        string $key,
        string $info,
        bool $req = false,
        $default = null
    ): object {
        $d = new \stdClass;
        $d->key = $key;
        $d->info = $info;
        $d->req = $req;
        $d->default = $default ?? '---';
        return $d;
    }
}
