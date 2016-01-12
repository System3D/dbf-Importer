var ref;

$(document).ready(function() {
    ref = $('#example').dataTable({
        "bLengthChange": false,
        "bPaginate": false,
        "sScrollX":"100%",
        "sScrollXInner":"110%"
    }).rowGrouping({
        bExpandableGrouping: true,
        bExpandSingleGroup: false,
        iExpandGroupOffset: -1
    });
    var oFC = new FixedColumns( ref,{
            "iLeftColumns": 0,
            "iRightColumns": 1,
            "iRightWidth": 110,
            "sRightWidth":"fixed",
            "sHeightMatch":"auto"
    });  
    
     $('.expandedOrCollapsedGroup').live('click', function() {
        if ($(this).hasClass('collapsed')) {
            $(this).addClass('expanded').removeClass('collapsed').val('Collapse All').parents('.dataTables_wrapper').find('.collapsed-group').trigger('click');
        }
        else {
            $(this).addClass('collapsed').removeClass('expanded').val('Expand All').parents('.dataTables_wrapper').find('.expanded-group').trigger('click');
        }
    });
    
    ref.live('filter',function() {
        clearTimeout(ref.data('timeout'));
       var timeoutId = setTimeout(function(){
           if($('label:contains(Search: ) input').val() != '') {
              // ref.$('td', {"filter": "applied"}).find('.collapsed-group').trigger('click');
              $('.group-item-expander.collapsed-group').trigger('click');
           }
           else {
               //ref.$('td', {"filter": "applied"}).find('.expanded-group').trigger('click');
               $('.group-item-expander.expanded-group').trigger('click');
           }
       },2000);
       ref.data('timeout',timeoutId);
    });
    
     $("#resetsearch").live('click',function(e) {
        ref.fnFilter('');
         GridRowCount();
    });
    
    GridRowCount();
    ResetSearchField();
});

function GridRowCount() {
    $('span.rowCount-grid').remove();
    $('input.expandedOrCollapsedGroup').remove();

    $('.dataTables_wrapper').find('[id|=group-id]').each(function() {
        var rowCount = $(this).nextUntil('[id|=group-id]').length;
        $(this).find('td').append($('<div />', {'class': 'rowCount-grid'}).prepend($('<b />', {'text': "(" + rowCount + ")"})));
    });

    $('.dataTables_wrapper').find('.dataTables_filter').prepend($('<input />', {'type': 'button', 'class': 'expandedOrCollapsedGroup collapsed', 'value': 'Expand All'}));
};

function ResetSearchField() {
    var dataTableFilter = find(".dataTables_filter");
    $('.dataTables_wrapper').find('.dataTables_filter').append($('<input />', {
        'type': 'image',
        'class': 'ui-icon ui-icon-closethick float-right',
        'id': 'resetsearch'
    }));
};