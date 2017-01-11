<template>

    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" :style="style_modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{name}}</h4>
                </div>
                <div class="modal-body">

                    <div class="main-box-body clearfix">

                        <header class="main-box-header clearfix">

                            <div class="filter-block pull-right">

                                <div class="input-group">

                                    <span class="input-group-btn">

                                        <button class="btn btn-default no-border-radius" type="button">
                                            {{trans('grid.filters')}}
                                        </button>

                                    </span>

                                    <input type="text" id="searchFilter" class="form-control" placeholder="Busca..."
                                           @keydown.enter="addFilter" v-model="search_input">

                                    <span class="input-group-btn">

                                        <button id="searchButton" class="btn btn-default" type="button" @click="addFilter">
                                            <span class="fa fa-search"></span>
                                        </button>

                                    </span>

                                </div>

                            </div>
                        </header>

                        <br/>

                        <div class="row">
                            <div class="btn-toolbar" role="toolbar" aria-label="data-grid-applied-filters">

                                <div class="btn-group data-grid_applied" v-for="item,index in filter.items">
                                    <button class="btn btn-default btn-sm" @click="removeFilter(index)" type="button">
                                        <span><i class="fa fa-trash-o"></i></span>
                                        {{item}}
                                    </button>
                                </div>

                            </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th v-for="column,key in columns" @click="toggleOrder(key)"
                                                style="cursor:pointer;">
                                                {{column}}
                                                <span class="glyphicon" v-if="order_column === key">
                                                    <span v-if="direction === 'desc'" class="glyphicon-chevron-down">
                                                    </span>
                                                    <span v-else class="glyphicon-chevron-up">
                                                    </span>
                                                </span>
                                                <span v-else class="glyphicon">
                                                    <span class="glyphicon-chevron-up"></span>
                                                </span>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr v-for="entry in model.data">
                                            <td v-for="column,key in columns" @click="modalSelectItem(entry)" data-dismiss="modal" style="cursor:pointer">
                                                {{getValue(entry, key)}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <nav>
                                        <ul class="pagination pull-left" v-if="model.total > 0">
                                            <span>{{trans('grid.show')}} <b>{{model.from}} - {{model.to}}</b> {{trans('grid.of')}} <b>{{model.total}}</b></span>
                                        </ul>
                                        <span v-else>
                                            {{trans('grid.no_results_found')}}
                                        </span>

                                        <ul class="pagination pull-right" v-if="model.total > 0">
                                            <li v-if="model.current_page != 0">
                                                <a href="#" aria-label="Previous"
                                                   @click="model.current_page--, fetchIndexData()">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li v-else>
                                                <a href="#" aria-label="Previous" disabled>
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li v-for="(page,index) in model.last_page"
                                                :class="{'active': model.current_page-1 == index}">
                                                <a href="#" @click="model.current_page = index+1, fetchIndexData()">{{
                                                    index+1 }}</a>
                                            </li>
                                            <li v-if="model.last_page != model.current_page">
                                                <a href="#" aria-label="Next"
                                                   @click="model.current_page++, fetchIndexData()">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                            <li v-else>
                                                <a href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('grid.close')}}</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>

    export default{
        props: ['source', 'token', 'name', 'callback', 'id', 'style_modal', 'class_filter'],
        data(){
            return{
                model: {
                    current_page: 0,
                    data: {},
                    last_page: 0,
                    next_page_url: '',
                    per_page: 10,
                    prev_page_url: '',
                    to: 10,
                    total: 0,
                },
                columns: {},
                order_column: 'id',
                direction: 'asc',
                per_page: 10,
                filter: {
                    items: []
                },
                search_input: '',
                show: true
            }
        },
        methods: {

            fetchIndexData() {

                var vm = this

                var classFilter = '';
                if ( this.class_filter != null ){
                    classFilter = '?class_filter=' + this.class_filter
                }

                $.ajax({
                    type: "GET",
                    url: this.source + '/grid' + classFilter,
                    data: {
                        page: vm.model.current_page,
                        order_column: vm.order_column,
                        direction: vm.direction,
                        per_page: vm.per_page,
                        filters: vm.filter.items
                    },
                }).done(function(response) {

                    Vue.set(vm.$data, 'model', response.model)
                    Vue.set(vm.$data, 'columns', response.columns)

                }.bind(this));

            },
            addFilter(e){

                e.preventDefault();

                if ( this.search_input != '' ){
                    this.filter.items.push(this.search_input)
                    this.search_input = ''
                    this.fetchIndexData()
                }

            },
            removeFilter(index){
                this.filter.items.splice(index, 1)
                this.fetchIndexData()
            },
            toggleOrder(column) {

                var vm = this
                vm.model.current_page = 1;

                if(column === vm.order_column) {
                    if(vm.direction === 'desc') {
                        vm.direction = 'asc'
                    } else {
                        vm.direction = 'desc'
                    }
                } else {
                  vm.order_column = column
                  vm.direction = 'desc'
                }

                this.fetchIndexData()

            },
            modalSelectItem(item){
                var fn = window[this.callback];
                fn(item);
            },
            getValue(obj, path){
                for (var i=0, path=path.split('.'), len=path.length; i<len; i++){
                    obj = obj[path[i]];
                };
                return obj;
            }
        },
        created(){
            this.fetchIndexData();
        }
    }


</script>