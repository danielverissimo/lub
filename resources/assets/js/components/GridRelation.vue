<template>

<div class="main-box-body clearfix">

    <br/>
    <div class="form-group">

        <button type="button" class="btn btn-info" data-toggle="modal" :data-target="'#grid-modal-'+relation">
            <i class="fa fa-plus-circle"></i> Adicionar {{name}}
        </button>

        <grid-modal
                :id="'grid-modal-'+relation"
                :source="'/'+relation"
                :token="token"
                :name="model_name">
        </grid-modal>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="cursor:pointer;">
                            {{name}}
                        </th>
                        <th>
                            AÇÕES
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr v-for="entry in model">
                            <td width="90%">
                                {{entry[column]}}
                            </td>
                            <td class="actions" width="10%">

                                <a href="#" class="table-link danger" @click="deleteReg(entry.id)" data-toggle="tooltip" data-placement="top" title="Excluir">
                                    <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                </span>

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


</template>

<script>

    export default{
        props: ['path', 'token', 'column', 'name', 'model_id', 'relation', 'model_name'],
        data(){
            return{
                model: {
                    data: {}
                }
            }
        },
        methods: {

            fetchIndexData() {

                var vm = this

                $.ajax({
                    type: "GET",
                    url: '/' + this.path + '/' + this.model_id + '/' + this.relation,
                    data: {
                    },
                }).done(function(response) {
                    Vue.set(vm.$data, 'model', response.model)
                }.bind(this));

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

                        var data = {};
                        data['_token'] = vm.token;
                        data['_method'] = 'delete';
                        data[vm.relation] = id;

                        $.ajax({
                            type: "DELETE",
                            url: '/' + vm.path + '/' + vm.model_id + '/' + vm.relation,
                            data,
                            success: function(data, status, xhr) {

                                Vue.set(vm.$data, 'model', data.model)

                                swal({
                                    title: "Sucesso!",
                                    type:  "success",
                                    text:  "Registro excluido com sucesso.",
                                    timer: 2000
                                });

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
            itemSelected(item){

                var vm = this

                if ( !this.exist(item.id) ){

                        var data = {};
                        data['_token'] = vm.token;
                        data[this.relation] = item.id;

                        $.ajax({
                            type: "POST",
                            url: '/' + vm.path + '/' + vm.model_id + '/' + vm.relation,
                            data,
                            success: function(data, status, xhr) {

                                Vue.set(vm.$data, 'model', data.model)
                                console.log(item.id)

                                swal({
                                    title: "Sucesso!",
                                    type:  "success",
                                    text:  "Operação realizada com sucesso.",
                                    timer: 1000
                                });

                            },
                            error: function(xhr, status, error) {
                                swal("Erro!", "Houve um erro ao processar esta operação!.", "error")
                            }
                        });
                }else{
                    swal({
                        title: "Alerta!",
                        type:  "warning",
                        text:  "Não foi possível adicionar este elemento, ele já existe na lista.",
                        timer: 2000
                    });
                }

            },
            exist(id){

                for(var i=0; i < this.model.length; i++){

                    if ( this.model[i].id == id ){
                        return true;
                    }
                }

                return false;
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