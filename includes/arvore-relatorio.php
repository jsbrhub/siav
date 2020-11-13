<style>
    .sui-treeview-item-text{
        font-size: 12px;
    }
    .sui-treeview{
        background: gainsboro;
        border-radius: 5px ;
    }
</style>
<script>
    $(document).ready(function(){

        var icon = "img/folder.png";

        var camposModel = {
            empresa : {
                cnpj: true
            },
            contatoempresa: {
                contato: true
            },
            acionista: {

            }
        };

        $("#treeview").shieldTreeView({
            dataSource: {
                data: [
                    {
                        text: "Dados da Empresa", iconUrl: icon,  checked: true, items: [
                            { text: "Identificação da empresa", iconUrl: icon, checked: true, items: [
                                    { text: "CNPJ", checked: true, table: "empresa",  column: "cnpj" },
                                    { text: "Ano Base",checked: true, table: "empresa", column: "anoBase" },
                                    { text: "Razão Social", checked: true, table: "empresa", column: "razaoSocial" },
                                    { text: "CNPJ Matriz (caso seja filial)", checked: true, table: "empresa", column: "cnpjMatriz" },
                                    { text: "Telefone", checked: true, table: "empresa", column: "telefone" },
                                    { text: "Fax", checked: true, table: "empresa", column: "fax" },
                                    { text: "E-mail da Empresa", checked: true, table: "empresa", column: "email" },
                                    { text: "Endereço", checked: true, table: "empresa", column: "endereco" },
                                    { text: "CEP", checked: true, table: "empresa", column: "cep" },
                                    { text: "Complemento", checked: true, table: "empresa", column: "complemento" },
                                    { text: "Bairro", checked: true, table: "empresa", column: "bairro" },
                                    { text: "UF", checked: true, table: "empresa", column: "uf" },
                                    { text: "Municipio", checked: true, table: "empresa", column: "municipio" }
                                ] },
                            { text: "Contato", iconUrl: icon, checked: true, items: [
                                    { text: "Nome do Contato", checked: true, table: "contatoempresa",  column: "contato" },
                                    { text: "Função na Empresa",checked: true, table: "contatoempresa", column: "funcao" },
                                    { text: "E-mail", checked: true, table: "contatoempresa", column: "email" },
                                    { text: "Telefone", checked: true, table: "contatoempresa", column: "telefone" }
                                ] },
                            { text: "Sócio/Acionista Controlador", iconUrl: icon, checked: true, items: [
                                    { text: "Nome do Sócio/Acionista Controlador", checked: true, table: "acionista",  column: "nome" },
                                    { text: "E-mail",checked: true, table: "acionista", column: "email" },
                                    { text: "Cargo/Função", checked: true, table: "acionista", column: "funcao" },
                                    { text: "CPF ou CNPJ", checked: true, table: "acionista", column: "cpfCnpj" },
                                    { text: "Estrangeiro", checked: true, table: "acionista", column: "estrangeiro" }
                                ] },
                            { text: "Responsáveis Pela Empresa", iconUrl: icon, checked: true, items: [
                                    { text: "Nome", checked: true, table: "responsaveis",  column: "nome" },
                                    { text: "E-mail",checked: true, table: "responsaveis", column: "email" },
                                    { text: "Cargo/Função", checked: true, table: "responsaveis", column: "cpf_passaporte" }
                                ] }
                        ]
                    },
                    {
                        text: "Linha de Produção", iconUrl: icon,  checked: true, items: [
                            { text: "Produto/Serviço", iconUrl: icon, checked: true, items: [
                                    { text: "Produto/Serviço Incentivado", checked: true, table: "incentivoempresa",  column: "produtoIncentivado" },
                                    { text: "Capacidade Real Instalada",checked: true, table: "incentivoempresa", column: "capacidadeInstalada" },
                                    { text: "Produção", checked: true, table: "incentivoempresa", column: "producao" },
                                    { text: "Faturamento Bruto", checked: true, table: "incentivoempresa", column: "faturamento" },
                                    { text: "Empregos Diretos", checked: true, table: "incentivoempresa", column: "emprego" },
                                    { text: "CNAE 2.0", checked: true, table: "incentivoempresa", column: "cnae" }
                                ]
                            },
                            { text: "Origem de insumos", iconUrl: icon, checked: true, items: [
                                    { text: "Insumo", checked: true, table: "origeminsumos",  column: "insumo" },
                                    { text: "Regional",checked: true, table: "origeminsumos", column: "quantidadeRegional" },
                                    { text: "Nacional", checked: true, table: "origeminsumos", column: "quantidadeNacional" },
                                    { text: "Exterior", checked: true, table: "origeminsumos", column: "quantidadeExterior" }
                                ]
                            },
                            { text: "Mercado Consumidor", iconUrl: icon, checked: true, items: [
                                    { text: "Regional",checked: true, table: "mercadoconsumidor", column: "quantidadeRegional" },
                                    { text: "Nacional", checked: true, table: "mercadoconsumidor", column: "quantidadeNacional" },
                                    { text: "Exterior", checked: true, table: "mercadoconsumidor", column: "quantidadeExterior" }
                                ]
                            }
                        ]
                    },
                    {
                        text: "Dados Financeiros", iconUrl: icon,  checked: true, items: [
                            { text: "Faturamento Bruto", checked: true, table: "cadastrofinanceiro",  column: "faturamentoBruto" },
                            { text: "Faturamento com Produtos Incentivados", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Imobilizado Total", checked: true, table: "cadastrofinanceiro",  column: "imobilizadoTotal" },
                            { text: "Investimento em Capital Fixo", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Remuneração do Capital Próprio", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Remuneração do Capital de Terceiros", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Pessoal de Encargos", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Impostos, Taxas e Contribuições", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Valor Pago de ICMS", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Valor Pago de ISSQN", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Valor do IR Total Não Descontado da Redução/Isenção de ICMS", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Valor do Desconto do IR Referente à Redução/Isenção", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Valor do IR Descontado da Redução/Isenção", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Reserva de Incentivo Fiscal", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Reserva Apropriada do exercicio", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Reserva de Reinvestimento", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Empregos Diretos Existentes em 31/12", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Empregos Indiretos Existentes em 31/12", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Empregos Terceirizados Existentes em 31/12", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Despesas com Empregos Terceirizados", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Empregos Diretos Oriundos do Municipio em 31/12", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" }
                        ]
                    },
                    {
                        text: "Projetos/Programas", iconUrl: icon,  checked: true, items: [
                            { text: "Nome do Projeto", checked: true, table: "cadastrofinanceiro",  column: "faturamentoBruto" },
                            { text: "Total de Despesas", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Quantidade de pessoas", checked: true, table: "cadastrofinanceiro",  column: "imobilizadoTotal" }
                        ]
                    },
                    {
                        text: "Destinação Sustentavel", iconUrl: icon,  checked: true, items: [
                            { text: "Residuos Gerados", checked: true, table: "cadastrofinanceiro",  column: "faturamentoBruto" },
                            { text: "Quantidade de Residuos Gerados ou Descartados", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" },
                            { text: "Quantidade de Residuos Tratados", checked: true, table: "cadastrofinanceiro",  column: "faturamentoProdIncentivados" }
                        ]
                    }
                ]
            },
            checkboxes: {
                enabled: true,
                children: true
            },
            events: {
                check: function(e){
                    var treeview = $("#treeview").swidget();


                    console.log(treeview.getItem(e.element));

                    if(e.checked){
                        $("input[type='checkbox']", e.element).prop("checked", true);
                    }  else {
                        $("input[type='checkbox']", e.element).prop("checked", false);
                    }
                }
            }

        });
    });
</script>

<ul id="treeview"></ul>