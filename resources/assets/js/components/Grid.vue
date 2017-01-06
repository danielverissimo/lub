<template>

<div class="main-box-body clearfix">

    <header class="main-box-header clearfix">
        <h2 class="pull-left">{{name}}</h2>

        <div class="filter-block pull-right">

            <div class="input-group">

                <span class="input-group-btn">

                    <button class="btn btn-default" type="button">
                        Exportar
                    </button>

                    <button type="button" class="btn btn-default border-radius" data-toggle="dropdown">
                        <span class="fa fa-download"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#" @click="exportFile('xls')">
                                <i class="fa fa-file-excel-o"></i>
                                Exportar Excel
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="exportFile('pdf')">
                                <i class="fa fa-file-pdf-o"></i>
                                Exportar PDF
                            </a>
                        </li>
                    </ul>



                </span>

                <span class="input-group-btn">

                    <button class="btn btn-default no-border-radius" type="button">
                        Filtros
                    </button>

                </span>

                <input type="text" id="searchFilter" class="form-control" placeholder="Busca..." @keyup.enter="addFilter()" v-model="search_input">

                <span class="input-group-btn">

                    <button id="searchButton" class="btn btn-default" type="submit" @click="addFilter()">
                        <span class="fa fa-search"></span>
                    </button>

                    <button class="btn btn-primary" type="submit" @click="addNew()">
                        <span class="fa fa-plus-circle"></span>
                    </button>

                </span>

            </div>

        </div>
    </header>

    <br/>

    <div class="row">
        <div class="btn-toolbar" role="toolbar" aria-label="data-grid-applied-filters">

            <div class="btn-group data-grid_applied" v-for="item,index in filter.items">
                <button class="btn btn-default btn-sm" @click="removeFilter(index)">
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
                        <th v-for="column,key in columns" @click="toggleOrder(key)" style="cursor:pointer;">
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
                        <th>
                            AÇÕES
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="entry in model.data">
                        <td v-for="column,key in columns">
                            {{getValue(entry, key)}}
                        </td>
                        <td class="actions">

                            <a :href="source + '/' + entry.id +'/edit'" class="table-link" data-toggle="tooltip" data-placement="top" title="Editar/Visualizar">
                                <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>

                            <a href="#" class="table-link danger" @click="deleteReg(entry.id)" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </td>

                    </tr>
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination pull-left" v-if="model.total > 0">
                        <span>Apresentando <b>{{model.from}} - {{model.to}}</b> de <b>{{model.total}}</b></span>
                    </ul>
                    <span v-else>
                        Nenhum Resultado Encontrado!
                    </span>

                    <ul class="pagination pull-right" v-if="model.total > 0">
                        <li v-if="model.current_page != 0">
                            <a href="#" aria-label="Previous" @click="model.current_page--, fetchIndexData()">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li v-else>
                            <a href="#" aria-label="Previous" disabled>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li v-for="(page,index) in model.last_page" :class="{'active': model.current_page-1 == index}">
                            <a href="#" @click="model.current_page = index+1, fetchIndexData()">{{ index+1 }}</a>
                        </li>
                        <li v-if="model.last_page != model.current_page">
                            <a href="#" aria-label="Next" @click="model.current_page++, fetchIndexData()">
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


</template>

<script>

    export default{
        props: ['source', 'token', 'name'],
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
                search_input: ''
            }
        },
        methods: {

            fetchIndexData() {

                var vm = this

                $.ajax({
                    type: "GET",
                    url: this.source + '/grid',
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
            addNew(){
                window.location = this.source + '/create'
            },
            exportFile(type){

                var vm = this

                var filters = '';
                for(var i=0; i < vm.filter.items.length; i++){
                    filters += '&filters[]=' + vm.filter.items[i];
                }

                window.location = this.source + '/export?type=' + type + filters;

            },
            addFilter(){

                if ( this.search_input != '' ){
                    this.filter.items.push(this.search_input)
                    this.search_input = ''
                    this.fetchIndexData()
                }else{

                    $('#searchButton').removeClass('btn-default').addClass('disabled');
                    $('#searchFilter').attr('disabled', '');

                    var notification = new NotificationFx({
                        message: '<p>Não é possível adicionar um filtro vazio.</p>',
                        layout: 'growl',
                        effect: 'jelly',
                        type: 'warning', // notice, warning, error or success
                        ttl : 3000,
                        onClose: function () {
                            $('#searchButton').removeClass('disabled').addClass('btn-default');
                            $('#searchFilter').attr('disabled', false);
                        }
                    }).show();
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
            deleteReg(id){

                var vm = this

                swal({
                    title: "Excluir Registro...",
                    text: 'Tem certeza que deseja excluir este registro?',
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim, tenho certeza!",
                    cancelButtonText: "Não",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            type: "POST",
                            url: vm.source + '/' + id,
                            data: {
                                '_token': vm.token,
                                '_method': 'delete'
                            },
                            success: function(data, status, xhr) {

                                swal("Sucesso!", "Registro excluido com sucesso.", "success")
                                vm.fetchIndexData()
                            },
                            error: function(xhr, status, error) {
                                swal("Erro!", "Houve um erro ao processar esta operação!.", "error")
                            }
                        });


                    } else {
                        swal("Operação Cancelada", "Todas as informações estão como antes!", "error")
                    }
                });

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