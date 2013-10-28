
$(document).ready(function(){$(".numbersOnly").bind('keyup paste',function(e){var ob=$(this);if(e.type=='paste'){setTimeout(function(){numbersOnly(ob)},1);}else numbersOnly(ob);});$('.floatOnly').keyup(function(){this.value=this.value.replace(/[^0-9\.]/g,'');});$('.items .icon-status').live('click',function(){mName=$('#moduleName').val();img=this;$.ajax({type:'POST',url:baseUrl+'/'+mName+'/changeStatus',data:{id:img.name,ajax:true,YII_CSRF_TOKEN:YII_CSRF_TOKEN},success:function(){if(img.alt=='enabled'){img.alt='disabled';img.src=baseUrl+'/css/admin/images/publish_x.png';}else{img.alt='enabled';img.src=baseUrl+'/css/admin/images/tick.png';}}});});});function numbersOnly(ob){ob.val(ob.val().replace(/[^0-9]/g,''));}
function deleteAll(containerID,url){var $selection=$.fn.yiiGridView.getSelection(containerID);if($selection=="")
{alert(LANG.DELETE_CHECKBOX_EMPTY);return;}
if(confirm(LANG.DELETE_ALL_CONFIRM))
{$.ajax({type:'POST',url:baseUrl+url,data:{ids:$selection,YII_CSRF_TOKEN:YII_CSRF_TOKEN},success:function($redirect){location.href=$redirect;}});}
return;}
function changeStatus(id,idReturn,ctrl){$('.grid-view').addClass('loading');$.ajax({type:"POST",url:baseUrl+"/"+ctrl+'/changeStatus',data:"id="+id+"&ajax=1&YII_CSRF_TOKEN="+YII_CSRF_TOKEN,success:function(data){if(data=='0')
$src=baseUrl+'/css/admin/images/publish_x.png';else
$src=baseUrl+'/css/admin/images/tick.png';$('#'+idReturn).attr('src',$src);$('.grid-view').removeClass('loading');}});}
function loadPage(url,id){$('.grid-view').addClass('loading');$.ajax({type:"GET",url:baseUrl+url,data:"ajax=1&YII_CSRF_TOKEN="+YII_CSRF_TOKEN,success:function(data){$('#'+id).html(data);$('.grid-view').removeClass('loading');}});}
function removeTableRow(index,tab){rowCount=$('#table-'+tab+'-grid tr').length;$('#'+tab+'-no-'+index).parent().remove();for(i=(index+1);i<rowCount+1;i++){$('#'+tab+'-no-'+i).html(i-1);$('#'+tab+'-no-'+i).attr('id',tab+'-no-'+(i-1));$('#'+tab+'-remove-row-'+i).html('<img src="'+assetPath+'/gridview/delete.png" onclick="removeTableRow('+(i-1)+', \''+tab+'\')"/>');$('#'+tab+'-remove-row-'+i).attr('id',tab+'-remove-row-'+(i-1));}}
function changeOptionStatus(attr,opt,pos){if(opt.checked){$('#'+attr+'_disabled_'+pos).attr('style','display: none');document.getElementById(attr+'_file_'+pos).disabled=true;}else{$('#'+attr+'_disabled_'+pos).attr('style','display: inline');document.getElementById(attr+'_file_'+pos).disabled=false;}}
function removeGroupItem(itemId,tabName,rmPrefix){if(tabName==undefined)
var tabName='group_item';if(rmPrefix==undefined)
var rmPrefix='group-item';ids=$('#'+tabName+'_id_list');itemIds=ids.val().split(",");for(var i=0;i<itemIds.length;i++){if(itemIds[i]==itemId){itemIds.splice(i,1);$('#group-remove-'+rmPrefix+'-'+itemId).parent().parent().remove();ids.attr('value',itemIds);if(ids.val()=="")
$('#group-btn-delete-rows').attr('disabled','disabled');return;}}}
function removeItem(itemId,listId,rmPrefix,idDelete){itemIds=$('#'+listId).val().split(",");for(var i=0;i<itemIds.length;i++){if(itemIds[i]==itemId){itemIds.splice(i,1);$('#'+rmPrefix+'-'+itemId).parent().parent().remove();$('#'+listId).attr('value',itemIds);if($("#"+listId).val()=="")
$('#'+idDelete).attr('disabled','disabled');if(itemPrices!=null){itemPrices.splice(i,1);$('#item_price_list').attr('value',itemPrices);}
return;}}}
function removeMoreItem(tabName){if(!$("input[name='select-row[]']:checked").attr('checked')){alert(LANG.DELETE_CHECKBOX_EMPTY);return;}
$("INPUT[name='select-row[]']:checked").each(function(){removeOneItem($(this).val(),tabName);});return;}
function sortArray(a,sortField,sort,array){if(array!='')
{$.ajax({type:"POST",url:baseUrl+'/statistic/sortArray',data:{sortField:sortField,sort:sort,data:array,key:a.rel,ajax:1},success:function(data){$('#report-data').html(data);}});}
return false;}
function gridviewDeleteButton(url){if(confirm(LANG.DELETE_ALL_CONFIRM)){window.location.href=url;}
return false;}
function removeSigned(str){str=str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");str=str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");str=str.replace(/ì|í|ị|ỉ|ĩ/g,"i");str=str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");str=str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");str=str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");str=str.replace(/đ/g,"d");str=str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g,"A");str=str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g,"E");str=str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g,"I");str=str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g,"O");str=str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g,"U");str=str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g,"Y");str=str.replace(/Đ/g,"D");str=str.replace(/-+-/g,"-");str=str.replace(/^\-+|\-+$/g,"");return str;}
function showMenthodSoap()
{var x=document.getElementById("protocol");x=x.value;if(x=='SOAP')
{$('.wsdl').show('10000');$('.http').hide('10000');$('.menthod_soap').show('10000');}
else
{$('.http').show('10000');$('.wsdl').hide('10000');$('.menthod_soap').hide('10000');}}
function showWapPush()
{var x=document.getElementById("msg_type");x=x.value;if(x=='1')
{$('.wap_push').show('10000');}
else
{$('.wap_push').hide('10000');}}
function searchSmsService($keyword,$smsc)
{$.ajax({type:"GET",url:baseUrl+'/smsService/getServices',data:{keyword:$keyword,smsc:$smsc},success:function(data){$('#showDuplicateService').hide();$('#showDuplicateService').html(data);$('#showDuplicateService').slideDown();}});}