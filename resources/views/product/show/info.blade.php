<div class="row pt-5">
    <div class="col-12 col-sm-6">
        <div class="btn-group">
            <button class="btn btn-clear" type="button">
                <h4 class="text-primary"
                    v-text="h.d.price || h.d.formatPrice({{$p->savedPrice}})">
                    ${{\number_format($p->savedPrice, 2)}}
                </h4>
            </button>
            <button type="button"
                class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu p-2">
                <a class="dropdown-item" href="#"
                    v-on:click.prevent="h.d.convertTo('EGP')">
                    @lang('t.show.conTo') @lang('t.show.EGP')
                </a>
                <a class="dropdown-item" href="#"
                    v-on:click.prevent="h.d.convertTo('EUR')">@lang('t.show.conTo')
                    @lang('t.show.EU')</a>
                <a class="dropdown-item" href="#"
                    v-on:click.prevent="h.d.convertTo('USD')">@lang('t.show.conTo')
                    @lang('t.show.USD')</a>
            </div>
        </div>
        @if ($p->save)
        <h5><del class="text-muted">${{\number_format($p->price, 2)}}</del>
            &nbsp;-&nbsp;
            <span
                class="text-muted">@lang('t.youSave') 
                {{\number_format($p->price - $p->savedPrice, 2)}}
            </span>
        </h5>
        @endif
        <p>
            <strong>@lang('t.show.color'):</strong>
            <span class="p-1 px-2 border border-dark">{{$p->color[0]}}</span>
        </p>
        <p>
            <strong class="d-block">@lang('t.show.desc')</strong>
            <span>{{$p->info}}</span>
        </p>
    </div>
    <div class="col-12 col-sm-6">
        <div class="d-block">
            <div class="row">
                <div class="col-4">
                    <select class="custom-select" name="cartAmount"
                        v-model="h.d.cartAmount">
                        @foreach (range(1, $p->amount) as $i)
                        <option :value='{{$i}}'>{{$i}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-8">
                    <button class="btn btn-primary btn-block mb-2"
                        v-on:click="h.d.addToCart('{{
                            $p->makeHidden(['rates', 'pi', 'user'])->toJson()
                        }}', h.d.cartAmount)"
                        @if ($p->amount < 1)disabled @endif>
                            <x-btn-loader :id="$p->id.'spinnerLoader'">
                            </x-btn-loader>
                            @lang('t.addCart')
                    </button>
                </div>
            </div>
            <strong class="text-danger">{{$p->amount}}
                @lang('t.show.stock')</strong>
        </div>
        <hr />
        <div class="d-block">
            <p>
                <strong>@lang('t.show.cond'):</strong>
                <span>
                    {{$p->is_used ? __('t.show.used') : __('t.show.new')}}
                </span>
            </p>
            <p>
                <strong>@lang('t.show.soldBy'):</strong>
                <span>
                    {{$p->user->name}}
                </span>
            </p>
        </div>
        <div class="row">
            <div class="col-6">
                @can('update', $p)
                <a href="/{{app()->getLocale()}}/user/{{auth()->id()}}/p/{{$p->slug}}/edit"
                    class="btn btn-info">
                    <i class="fa fas fa-edit"></i>
                    @lang('t.user.edit')
                </a>
                @endcan
            </div>
            <div class="col-6">
                @can ('delete', $p)
                <button class="btn btn-danger btn-block"
                    onclick="document.querySelector('#delSpinner').classList.remove('d-none');document.querySelector('#deleteForm').submit()">
                    <x-btn-loader id="delSpinner">
                    </x-btn-loader>
                    <i class="fa fas fa-times"></i>
                    @lang('t.user.delete')
                </button>
                <form class="d-none" id="deleteForm"
                    action="/{{app()->getLocale()}}/p/{{$p->slug}}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" />
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>