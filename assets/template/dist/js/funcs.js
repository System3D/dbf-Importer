$(document).ready(function() {


  $('#normalTable').DataTable({
         responsive: true
    });



    var table = $('#dataTables').DataTable({
        responsive: true,
        "ordering": false,
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );

 var Basepath = "http://localhost/s4w";
    $('#tableData').DataTable({
         responsive: true
    }); 

        $.fn.editable.defaults.mode = 'popup';
        $('.xedit').editable();     
        $(document).on('click','.editable-submit',function(){
        var key = $(this).closest('.editable-container').prev().attr('key');
        var x = $(this).closest('.editable-container').prev().attr('id');
        var y = $('.input-sms').val();
        var z = $(this).closest('.editable-container').prev().text(y);

            $.ajax({
                type: "POST",
                url: Basepath + "/saas/conjuntos/editTable",
                data: {id:x, data:y, key:key},
                success: function(s){
                    if(s == 'status'){
                    $(z).html(y);}
                    if(s == 'error') {
                    alert('Error Processing your Request!');}
                },
                error: function(e){
                    alert('Error Processing your Request!!');
                }
            });
        });

});

