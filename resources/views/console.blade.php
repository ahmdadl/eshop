@extends('layouts.app', ['cpt' => 'console'])

@section('title')
eshop Developers Console
@endsection

@section('content')
<div class="row">
    <div class="col-sm-3 mb-3">
        <div class="list-group list-group-flush">
            @foreach ($doc as $d)
            @isset ($d->parent)
            <h6 class="pt-1 font-weight-bold">{{$d->parent}}</h6>
            @endif
            <a href="#" id="page{{$loop->index}}" v-on:click.prevent.stop="h.d.setDoc({{$loop->index}})"
                class="list-group-item list-group-item-action pageLink 
            @if ($loop->first) active text-light @endif
            @if ($d->method === 'POST') text-danger @else text-primary @endif
            " style="word-break:break-all">
                {{$d->method}} {{$d->route}}
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-sm-6">
        <h4
            v-text="h.d.doc.method + ' ' + h.d.doc.route || '{{$doc[0]->method}} {{$doc[0]->route}}'">
        </h4>
        <p v-text="h.d.doc.info || '{{$doc[0]->info}}'"></p>
        <code class="bg-dark p-2"
            v-text="h.d.doc.url_with_params || '{{$doc[0]->url_with_params}}'">
        </code>
        <hr class="bg-secodary" />
        <h4 class="mt-2">Request</h4>
        <table class="table table-striped table-borderless"
            v-if="h.d.doc.url_params.length">
            <thead>
                <tr>
                    <th colspan="3">URL PARAMETER</th>
                    <th>Default</th>
                    <th>Required</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="url in h.d.doc.url_params">
                    <td colspan="3">
                        <span class="text-uppercase">
                            @{{url.key}}
                        </span>
                        <p class="text-muted">
                            @{{url.info}}
                        </p>
                    </td>
                    <td class="text-center">
                        @{{url.default}}
                    </td>
                    <td class="text-center">
                        <i v-if="url.req" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-times text-danger"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-borderless"
            v-if="h.d.doc.headers.length">
            <thead>
                <tr>
                    <th colspan="3">HEADER</th>
                    <th>Default</th>
                    <th>Required</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="h in h.d.doc.headers">
                    <td colspan="3">
                        <span class="text-uppercase">
                            @{{h.key}}
                        </span>
                        <p class="text-muted">
                            @{{h.info}}
                        </p>
                    </td>
                    <td class="text-center">
                        @{{h.default}}
                    </td>
                    <td class="text-center">
                        <i v-if="h.req" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-times text-danger"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped table-borderless"
            v-if="h.d.doc.query.length">
            <thead>
                <tr>
                    <th colspan="3">QUERY PARAMETER</th>
                    <th>Default</th>
                    <th>Required</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="q in h.d.doc.query">
                    <td colspan="3">
                        <span class="text-uppercase">
                            @{{q.key}}
                        </span>
                        <p class="text-muted">
                            @{{q.info}}
                        </p>
                    </td>
                    <td class="text-center">
                        @{{q.default}}
                    </td>
                    <td class="text-center">
                        <i v-if="q.req" class="fa fa-check text-success"></i>
                        <i v-else class="fa fa-times text-danger"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4>Response</h4>
        <p>HTTP status:
            <span
                v-text="h.d.doc.res_doc[0] || '{{$doc[0]->res_doc[0]}}'"></span>
        </p>
        <p>Body: <span
                v-text="h.d.doc.res_doc[1] || '{{$doc[0]->res_doc[1]}}'"></span>
        </p>
    </div>
    <div class="col-sm-3 bash bg-dark text-success">
        <span class="position-absolute btn btn-secondary btn-sm" v-on:click="h.d.copyCurl()">
            <i class="fa fa-copy"></i>
        </span>
        <div class="p-2 pt-0" style="word-break:break-all">
            <p id="cli" class="pt-4"
                v-text="h.d.doc.test_curl || '{{$doc[0]->test_curl}}'">
            </p>
        </div>
        <div>
            <h4 class="text-secondary border-bottom border-secondary">Response
                <strong class="text-warning float-right">
                    <span
                        v-text="h.d.doc.res_doc[0] || '{{$doc[0]->res_doc[0]}}'"></span>
                </strong>
            </h4>
            <div class="p-1">
                <pre class="text-info"
                    v-text="h.d.doc.response || '{{$doc[0]->response}}'">
                </pre>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="d-none" id="vxdata" value="{{json_encode($doc)}}" />
@endsection