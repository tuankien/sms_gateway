function loadPopup(src, width, height){
    $.modal('<iframe src="' + src + '" height="'+height+'" width="'+width+'" frameborder="no">', {
            closeHTML:"",
            containerCss:{
                    border: "1px solid",
                    backgroundColor: "#fff",
                    borderColor: "#C3C3C3",
                    height: height,
                    padding: 5,
                    width: width
            },
            overlayClose:false,
            onOpen: function (dialog) {
                dialog.overlay.fadeIn('slow', function () {
                    dialog.data.hide();
                    dialog.container.fadeIn('slow', function () {
                        dialog.data.slideDown('slow');
                    });
                });
            }
    });
}

function addProductItem(){
    table = parent.$('#table_product_popup_grid');
    ids = parent.$('#item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(ids.val()!='')
                ids.attr('value',ids.val()+','+$('#'+this.id).val());
            else
                ids.attr('value',$('#'+this.id).val());

            data = $('#tr-product-grid-'+i).html();
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-product-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}

function addProductCoreItem(){
    table = parent.$('#table_product_popup_grid');
    ids = parent.$('#item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(ids.val()!='')
                ids.attr('value',ids.val()+','+$('#'+this.id).val());
            else
                ids.attr('value',$('#'+this.id).val());

            data = $('#tr-product-grid-'+i).html();
            data +='<td><input type"text" maxlength="7"  class="validateNum numbersOnly" name="qty_'+$('#'+this.id).val()+'" value="1" /></td>';
            data +='<td><input type"text" maxlength="10"  class="validateNum numbersOnly" name="value_'+$('#'+this.id).val()+'" value="0" /></td>';
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-product-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}

function addProductDiscountItem(){
    table = parent.$('#table_product_popup_grid');
    ids = parent.$('#item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(ids.val()!='')
                ids.attr('value',ids.val()+','+$('#'+this.id).val());
            else
                ids.attr('value',$('#'+this.id).val());

            data = $('#tr-product-grid-'+i).html();
            data +='<td><input type"text" maxlength="7"  class="validateNum numbersOnly" name="qty_'+$('#'+this.id).val()+'" value="1" /></td>';
            data +='<td><input type"text" maxlength="10"  class="validateNum numbersOnly" name="value_'+$('#'+this.id).val()+'" value="0" /></td>';
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-product-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}

function addOrderItems(){
    table = parent.$('#table-order-items-grid');
    itemIds = parent.$('#item_id_list');
    itemPrices = parent.$('#item_price_list');
    index = 0;

    $("INPUT[name='select-row[]']").each(function(i){
        if($(this).is(':checked')){
            this.checked = false;
            if(itemPrices.val()!='')
                itemPrices.attr('value',itemPrices.val()+',' + $('#price-'+this.value).val());
            else
                itemPrices.attr('value', $('#price-'+this.value).val());

            if(itemIds.val()!='')
                itemIds.attr('value',itemIds.val()+','+$(this).val());
            else
                itemIds.attr('value',$(this).val());

            data = $('#tr-product-grid-'+i).html();
            data += '<td><img id="remove-item-'+$(this).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$(this).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-product-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$('.numbersOnly').bind('keyup paste', function(e){
        var ob = $(this);
        if (e.type == 'paste'){
        setTimeout(function(){numbersOnly(ob)}, 1);
        }else{
            ob.val(ob.val().replace(/[^0-9]/g,''));
        }
    });

    parent.$.modal.close();
}

function addVmsProductItems(){
    table = parent.$('#table_product_grid');
    ids = parent.$('#item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(ids.val()!='')
                ids.attr('value',ids.val()+','+$('#'+this.id).val());
            else
                ids.attr('value',$('#'+this.id).val());

            data = $('#tr-product-grid-'+i).html();
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-product-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$('.numbersOnly').bind('keyup paste', function(e){
        var ob = $(this);
        if (e.type == 'paste'){
        setTimeout(function(){numbersOnly(ob)}, 1);
        }else{
            ob.val(ob.val().replace(/[^0-9]/g,''));
        }
    });

    parent.$.modal.close();
}

function addMemberItem(){
    table = parent.$('#table_member_grid');
    memberIds = parent.$('#item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(memberIds.val()!='')
                memberIds.attr('value',memberIds.val()+','+$('#'+this.id).val());
            else
                memberIds.attr('value',$('#'+this.id).val());

            data = $('#tr-member-grid-'+i).html();
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-member-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}

function addUserAssignItem(){
    table = parent.$('#table_userassign_grid');
    memberIds = parent.$('#item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(memberIds.val()!='')
                memberIds.attr('value',memberIds.val()+','+$('#'+this.id).val());
            else
                memberIds.attr('value',$('#'+this.id).val());

            data = $('#tr-userassign-grid-'+i).html();
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-member-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });

    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}

function addGroupAssignItem(){
    table = parent.$('#table_groupassign_grid');
    memberIds = parent.$('#group_item_id_list');
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(memberIds.val()!='')
                memberIds.attr('value',memberIds.val()+','+$('#'+this.id).val());
            else
                memberIds.attr('value',$('#'+this.id).val());

            data = $('#tr-groupassign-grid-'+i).html();
            data += '<td><img id="remove-item-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-member-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });

    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}


function getExitedIdList(url){
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        success: function(data){
            ids = $('#item_id_list').val();
            if((ids!='') && (data!='')) ids += ','+data;
            else if(data!='') ids = data;
            $('#exited_id_list').val(ids);
        }
    });
}

function addPopupItems(tblId, tabName){
    table = parent.$('#'+tblId);
    
    if(tabName == 'undefined')
        var tabName = 'item';
    
    ids = parent.$('#'+tabName+'_id_list');
    
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($('#'+this.id).is(':checked')){
            if(ids.val()!='')
                ids.attr('value',ids.val()+','+$('#'+this.id).val());
            else
                ids.attr('value',$('#'+this.id).val());

            data = $('#tr-'+tabName+'-grid-'+i).html();
            data += '<td><img id="remove-'+tabName+'-'+$('#'+this.id).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$('#'+this.id).val()+', \''+ tabName +'\')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-'+tabName+'-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#'+tabName+'_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$.modal.close();
}

function showOption(chk)
{
    if(!chk.checked)
    {
        $('#picker_button_color-code').hide();
        $('#color-image').show();
    }
    else
    {
        $('#color-image').hide();
        $('#picker_button_color-code').show();
    }

}

function addProductOptions(){
    $optionList = parent.$('#product-option-list');
    assignedIds = parent.$('#assignedIds').val();
    index = 0
    $("INPUT[name='id[]']").each(function(i){
        if($(this).is(':checked')){
            oId = this.value;
            if(assignedIds == '') assignedIds = this.value;
            else assignedIds += ',' +this.value;

            $selectAll = $('INPUT[name="allValue[]"]');
            $checked = 0;
            if($selectAll[i].checked) $checked = 1;

            $optionBox = $('<div class="clearfix optionBox" id="optionBox'+this.value+'">');
            $optionBox.append('<input type="hidden" value="'+this.value+'" name="options[id][]">');
            $optionBox.append('<input type="hidden"  id="allValue'+this.value+'" value="'+$checked+'" name="options['+this.value+'][checked]"> + ');
            
            $div = $('<div style="display: inline;" id="option'+this.value+'">');
            $div.append('<input type="text" value="'+$('#optionName'+this.value).val()+'" class="productInput" name="options['+this.value+'][name]">');
            $div.append('<img class="btnDelete" onclick="removeOption('+this.value+')" src="'+parent.assetPath+'/gridview/delete.png">');
            $optionBox.append($div);

            $table = $('<table id="table-option-item'+this.value+'" class="items">');
            $table.append('<thead><tr><th>'+LANG.NAME_LABEL+'</th><th>'+LANG.PRICE_LABEL+'</th><th>'+LANG.SORDER_LABEL+'</th><th>'+LANG.STATUS_LABEL+'</th><th>'+LANG.IMAGE_LABEL+'</th><th>&nbsp;</th></tr></thead>');
            
            $optionBox.append($table);

            if(!$selectAll[i].checked)
            {
                $div = $('<div class="fRight">');
                $div.append($('<input type="hidden" id="valueList'+this.value+'" value="">'));
                $div.append($('<input type="button" onclick="loadPopup(\'/'+parent.controllerId+'/addOptionValue?optionId='+this.value+'&valueList=\'+$(\'#valueList'+this.value+'\').val(), 900, 590);" value="'+LANG.ADD_OPTION_VALUE_LABLE+'" name="addValue2">'));
                $optionBox.append($div);
            }
            $optionList.append($optionBox);
            if($selectAll[i].checked)
            {
                valueList = '';
                $.ajax({
                    type: "POST",
                    url: baseUrl+'/'+parent.controllerId+'/getOptionItems',
                    data: {optionId: oId,ajax: 1},
                    async: false,
                    dataType: 'json',
                    success: function(data){
                        if(data != null)
                        {
                            $table = parent.$('#table-option-item'+oId);
                            $.each(data, function(k, v){
                                if(valueList == '') valueList = v.id;
                                else valueList += ',' + v.id;
                                $tr = $('<tr id="value'+v.id+'" class="odd">');
                                $td = $('<td>');
                                $td.append($('<input type="hidden" id="changeValueStatus'+v.id+'" value="1" name="options['+oId+'][changeValue][]">'));
                                $td.append($('<input type="hidden" value="'+v.id+'" name="options['+oId+'][value][item][]">'));
                                $td.append(v.name);
                                $tr.append($td);

                                $td = $('<td>');
                                $td.append($('<input type="text" value="'+v.price+'" name="options['+oId+'][value][price][]">'));
                                $tr.append($td);

                                $td = $('<td>');
                                $td.append($('<input type="text" value="'+v.sorder+'" name="options['+oId+'][value][sorder][]">'));
                                $tr.append($td);

                                $status = v.status;
                                $select = $('<select name="options['+oId+'][value][status][]"/>');
                                $.each(parent.itemStatus , function(k, v){
                                    $selected = false;
                                    if($status == k) $selected = true;
                                    $option = $('<option></option>');
                                    $option.val(k);
                                    $option.text(v);
                                    $option.attr('selected', $selected);
                                    $select.append($option);
                                });

                                $td = $('<td>');
                                $td.append($select);
                                $tr.append($td);

                                $td = $('<td class="center">');
                                $td.append($('<img src="'+baseUrl+'/data/products/options/'+oId+'/'+v.id+'/tiny.gif">'));
                                $tr.append($td);

                                $td = $('<td class="center">');
                                $td.append($('<img onclick="removeOptionValue('+oId+', '+v.id+')" src="'+parent.assetPath+'/gridview/delete.png">'));
                                $tr.append($td);

                                $table.append($tr);
                            });
                        }
                    }
                });
                $div = $('<div class="fRight">');
                $div.append($('<input type="hidden" id="valueList'+this.value+'" value="'+valueList+'">'));
                $optionBox.append($div);
            }
        }
    });
    
    parent.$('#assignedIds').val(assignedIds);
    parent.$.modal.close();
}

function addProductOptionItems(oId){
    $table = parent.$('#table-option-item'+oId);
    valueList = parent.$('#valueList'+oId).val();
    index = 0
    $("INPUT[name='select-row[]']").each(function(i){
        if($(this).is(':checked')){
            if(valueList == '') valueList = this.value;
            else valueList += ',' +this.value;

            $tr = $('<tr id="value'+this.value+'" class="odd">');

            $td = $('<td>');
            $td.append($('<input type="hidden" id="changeValueStatus'+this.value+'" value="1" name="options['+oId+'][changeValue][]">'));
            $td.append($('<input type="hidden" value="'+this.value+'" name="options['+oId+'][value][item][]">'));
            $td.append($('#optionName'+this.value).val());
            $tr.append($td);

            $td = $('<td>');
            $td.append($('<input type="text" value="'+$('#optionPrice'+this.value).val()+'" name="options['+oId+'][value][price][]">'));
            $tr.append($td);

            $td = $('<td>');
            $td.append($('<input type="text" value="'+$('#optionSorder'+this.value).val()+'" name="options['+oId+'][value][sorder][]">'));
            $tr.append($td);

            $status = $('#optionStatus'+this.value).val();
            $select = $('<select name="options['+oId+'][value][status][]"/>');
            $.each(parent.itemStatus , function(k, v){
                $selected = false;
                if($status == k) $selected = true;
                $option = $('<option></option>');
                $option.val(k);
                $option.text(v);
                $option.attr('selected', $selected);
                $select.append($option);
            });

            $td = $('<td>');
            $td.append($select);
            $tr.append($td);

            $td = $('<td class="center">');
            $td.append($('<img src="'+$('.optionImage'+this.value).attr('src')+'">'));
            $tr.append($td);

            $td = $('<td class="center">');            
            $td.append($('<img onclick="removeOptionValue('+oId+', '+this.value+')" src="'+parent.assetPath+'/gridview/delete.png">'));
            $tr.append($td);

            $table.append($tr);
        }
    });

    parent.$('#valueList'+oId).val(valueList);
    parent.$.modal.close();
}

function UpdateRetailDiscountItem(item_id, discount_price, discount_percent, discount_info, discount_time)
{
    var string_info = "";
    if(discount_price != '' || discount_info != '')
    {
        string_info += "Discount price: "+discount_price+"<br/>";
        string_info += "Sale off: " + discount_percent +"%<br/>";
        string_info += "Time: "+ discount_time +"<br/>";
    }
    if(discount_price == '0 VND') { string_info = '';}
    parent.$('#retail_discount_'+item_id).html(string_info);

    parent.$.modal.close();
}

function UpdateWholeSaleDiscountItem(item_id, discount_data)
{
    var string_info = "";
    if(item_id > 0)
    {
        string_info += discount_data;
    }
    parent.$('#wholesale_discount_'+item_id).html(string_info);
    parent.$.modal.close();
}

function DeleteWholeSaleDiscountItem(applied, id)
{
    if(confirm('Are you sure you want delete this item?'))
    {
        //Start Ajax process
        $.ajaxSetup ({
        cache: false
        });
        var Url = "/discount/delete";
        $.post(
        Url,
        {id:id, applied:applied},
        function(responseText){
            $('#item_'+id).html(responseText);
        },
        "html"
        );
    }
}

function addSmtpServers(){
    table = parent.$('#table-smtpserver-items-grid');
    itemIds = parent.$('#item_id_list');
    index = 0;

    $("INPUT[name='select-row[]']").each(function(i){
        if($(this).is(':checked')){
            this.checked = false;

            if(itemIds.val()!='')
                itemIds.attr('value',itemIds.val()+','+$(this).val());
            else
                itemIds.attr('value',$(this).val());

            data = $('#tr-smtp-server-grid-'+i).html();
            data += '<td><img id="remove-item-'+$(this).val()+'" src="'+parent.assetPath+'/gridview/delete.png" onclick="removeOneItem('+$(this).val()+')"/></td>';
            table.html(table.html()+'<tr class="'+$('#tr-smtp-server-grid-'+i).attr('class')+'">'+data+'</tr>');
            index++;
        }
    });
    if($('#item_id_list').val()!='')
        parent.$('#btn-delete-rows').removeAttr('disabled');

    parent.$('.numbersOnly').bind('keyup paste', function(e){
        var ob = $(this);
        if (e.type == 'paste'){
        setTimeout(function(){numbersOnly(ob)}, 1);
        }else{
            ob.val(ob.val().replace(/[^0-9]/g,''));
        }
    });

    parent.$.modal.close();
}