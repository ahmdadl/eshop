<?php

namespace App\Console\Commands;

trait VueFilesTxt {
    private static $App = <<<EOT
import { Vue } from 'vue-property-decorator';
import Axios from 'axios';
import Home from './pages/home';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    components: {
        Home,
    },
    data: {
        h: {}
    }
});    
EOT;

    private static $indexHtml = <<<'EOD'
<div :id="this.$options.name.toLowerCase() + '-page'">
    <slot></slot>
</div>
EOD;

    private static $super = <<<'TS'
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component({
    template: require('./index-template.html')
})
export default class Super extends Vue {
    @Prop({ type: Object, required: true }) data: {}
    d = {};
    _methods: string[] = [];

    public attachToGlobal(methods: string[]) {
        for (const k in this.$data) {
            this.d[k] = this.$data[k];
        }

        methods.map(x => (this.d[x] = this[x]));

        // @ts-ignore
        this.$root.h = this.d;
    }

    mounted() {
        this.attachToGlobal(this._methods);
    }
}
TS;

    private static $home = <<<'TS'
import { Component, Prop } from 'vue-property-decorator';
import Super from './super';

@Component
export default class Home extends Super {
    public log() {
        console.log('eee');
    }

    beforeCreate() {
        this._methods = ['log'];
    }
}
TS;

    private static $tsconfig = <<<'JSN'
{
    "compileOnSave": false,
    "compilerOptions": {
        "baseUrl": "./",
        "sourceMap": true,
        "declaration": false,
        "allowJs": true,
        "strictNullChecks": true,
        "downlevelIteration": true,
        "emitDecoratorMetadata": true,
        "experimentalDecorators": true,
        "importHelpers": true,
        "target": "es5",
        "module": "es2015",
        "moduleResolution": "node",
        "typeRoots": ["node_modules/@types"],
        "lib": ["dom", "es6"]
    }
}
JSN;

    private static $mix = <<<MX
const mix = require('laravel-mix');

mix.ts('resources/js/app.ts', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.browserSync('laravel.test');
MX;

    private static $layout = <<<'HML'
    <{{$component}} :data="h">
        @yield('content')
    </{{$component}}>
HML;

    private function getNewPageTxt($pageName) : string
    {
        return <<<TS
import { Component } from 'vue-property-decorator';
import Super from './super';

@Component
export default class $pageName extends Super {
    

    beforeCreate() {
        this._methods = [];
    }
}       
TS;
    }
}