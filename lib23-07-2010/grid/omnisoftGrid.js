
//------------------------------------------------------------------------------------------------------------------------
//  OCL Omnnisoft Component Library
//  PROYECTO: Librerias para el mantenimiento de base de datos
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//  VERSION:  2.1
//------------------------------------------------------------------------------------------------------------------------
//  TÍTULO: omnisoftGrid.js
//  DESCRIPCIÓN: Archivo que contiene la clase omnisoftGrid para la gestion de base de datos
//  FECHA DE CREACIÓN: 18-Diciembre-2007
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCIÓN
//  1) ------------- -------------  -------------------------


omnisoftGrid=function(aObjName, aTable,aKey,aSQLCommand,aFormulario,sWidth,sHeight,eFormulario,eWidth,eHeight,eButtons,eTitle) {
  // Database connectivity
   this.objName=aObjName;
   this.omnisoftRows=new Array();
   this.data=new Array();
   this.table=aTable;

   this.key=aKey;
   this.rTitle=(eTitle==undefined)? 'REPORTE' : eTitle;
   this.sqlCommand=aSQLCommand.toLowerCase();
   this.column=new Array();
   this.columnCount=0;
   this.SQLColumn=new Array();
   this.buttons=(eButtons==undefined)? Array(true,true,true): eButtons;


  // grid Object

    this.grid= new AW.Grid.Extended;
    this.grid.setOffset=function(offset){this.offset=offset};
    this.grid.setPageNo=function(pageno){this.pageno=pageno};
    this.grid.setRange=function(min,max){this.minimo=min;this.maximo=max};
    this.grid.getMin=function(){return this.minimo};
    this.grid.getMax=function(){return this.maximo};
    this.grid.setCells=function(Cells) {this.cells=Cells;};
    this.grid.setMaxRows=function(rows) {this.rows=rows;};
    this.setAutoSuggest=function(val){this.autoSuggest=val;};
    this.grid.getAutoSuggest=function(){return this.autoSuggest;};

    this.grid.rTitle=this.rTitle;
    this.grid.table=this.table;
    this.grid.key=this.key;
    this.grid.sqlCommand=this.sqlCommand;
    this.grid.orderby='';
    this.grid.action='';
    this.grid.selectedRow=0;
    this.grid.whereclause='';
    this.grid.fields=this.fields;
    this.grid.columnCount=0;
    this.grid.setFields=function(campo) {this.fields=campo};

    this.grid.getFields=function(i) {return this.fields[i];};
    this.grid.getFieldByColumnName=function(columnName) {for (var i=0; i < this.fields.length;i++) if (this.fields[i].columnName==columnName) return i; return -1};
    this.grid.setTotalRows=function(trows) {this.totalRows=trows;};
    this.grid.getTotalRows=function() {return this.totalRows;};
    this.grid.setSQLColumn=function(SQLColumn) {this.SQLColumn=SQLColumn};
    this.grid.getSQLColumn=function(i) {return this.SQLColumn[i];};
    this.grid.setOrderBy=function(orderby) {this.orderby=orderby};
    this.grid.getOrderBy=function(i) {return this.orderby;};
    this.grid.setWhere=function(whereclause) {if (this.sqlCommand.split('where')[1]) this.whereclause=(whereclause!='')?' and '+whereclause:''; else if (whereclause!='') this.whereclause=' where '+whereclause; else this.whereclause='';};
    this.grid.getWhere=function(i) {return this.whereclause;};
    this.grid.setDataTable=function(dataTable) {this.dataTable=dataTable};
    this.grid.formulario= (aFormulario!=undefined) ? aFormulario:'none';
    this.grid.sWidth= (sWidth!=undefined)? sWidth:0;
    this.grid.sHeight= (sHeight!=undefined)? sHeight:0;
    this.grid.sortDirection='';
    this.grid.sortIndex=0;
    this.grid.sqlCommand=this.sqlCommand;

    this.grid.formularioEditor= (eFormulario!=undefined) ? eFormulario:this.grid.formulario;
    this.grid.eWidth= (eWidth!=undefined)? eWidth:this.grid.sWidth;
    this.grid.eHeight= (eHeight!=undefined)? eHeight:this.grid.sHeight;

 // grid format

   this.rows=20;
   this.height=400;
   this.width=1020;
   this.font='Arial';
   this.bgcolor='#FF9900';



this.setSQLColumns=function () {
 this.SQLColumn=this.sqlCommand.split('select')[1].split('from')[0].split(',');
}
//  get data

this.initData=function (grid,sqlCommand,rows,dataBuffer) {

   var MyTable = AW.HTTP.Request.subclass();
    this.grid.setMaxRows(rows);

     MyTable.create = function(){

    var obj = this.prototype;

    obj._data = []; // data array
    obj._nrows=rows;

    obj.getData = function(col, row){
       //alert(this._data[row]);
       if (this._data[row] )
            return   this._data[row][col];


        return "";
    }


    obj.response = function(data){
        if (!this._data.length){
            this._data = [];
        }


        var recs=data.split('|');
        var startIndex = Number(this._startIndexParameter);
        var rowCount = recs.length-2; //Number(this._rowCountParameter);
        if (rowCount <0) rowCount=0;
        window.status = "Datos cargados " + startIndex + "-" + (startIndex+rowCount);
        var reg=recs[1].split('~');
        for (var i=0;i<rowCount;i++)
             this._data[i] = recs[i+1].split('~');

             this._nrows=rowCount;

        if (this.$owner){

          this.$owner.clearScrollModel();
          this.$owner.clearSelectedModel();
          this.$owner.clearSortModel();
          this.$owner.clearRowModel();

          this.$owner.setRowCount(rowCount);
          if (this.$owner.sortIndex!=0) {
              this.$owner.setSortColumn(this.$owner.sortIndex);
              this.$owner.setSortDirection(this.$owner.sortDirection, this.$owner.sortIndex);
          }
          this.$owner.refresh();

          this.$owner.focus();
          this.$owner.summary(reg.length-1);
          this.$owner.globalSummary();

        }
    }
}


    grid.dataTable = new MyTable();
    grid.offset=0;
    grid.pageno=0;

    grid.dataTable.setRequestMethod("POST");
    grid.dataTable.setURL("../lib/server/omnisoftRequestData.php");
    grid.dataTable.setParameter("startIndex", 0); //StartIndex
    grid.dataTable.setParameter("rowCount", this.rows);   // rowCount
    grid.dataTable.setParameter("query",sqlCommand);
    grid.dataTable.request();
}






 // show grid

   this.showGrid=function (gridName,pRows,pHeight,pWidth,pFont,pBGColor) {

        this.setSQLColumns();

        this.grid.setFields(this.column);
        this.grid.setSQLColumn(this.SQLColumn);


        // grid format
        this.rows=pRows;
        this.height=pHeight;
        this.width=pWidth;
        this.font=pFont;
        this.bgcolor=pBGColor;

        // grid display functions

        var visibleColumns=new Array();
        var columnStyle='';
        var columnHeaderText='';
        var columnHeaderFilter='';
        this.grid.setHeaderHeight(30,0);

        this.grid.getHeadersTemplate().setClass("text", "wrap");
        this.grid.getHeadersTemplate().setStyle('text-align', 'center');

        for (var i=0,j=0; i < this.columnCount; i++) {

            if (this.column[i].type!='hidden')
                visibleColumns[j++]=i;

                columnHeaderText='<label><input type="checkbox"  checked="false" id="check_'+this.column[i].columnName +'">Imprimir</label><input type="text" id="len_'+this.column[i].columnName +'" value="'+parseInt(this.column[i].width)+'" size="3">';
                columnHeaderFilter=new AW.UI.Input;

                this.grid.setHeaderText(this.column[i].label,i,0);
                this.grid.setHeaderText(columnHeaderText,i,1);
                this.grid.setHeaderTemplate(columnHeaderFilter,i,2);
                if (this.column[i].type=='checkbox') {
                    this.grid.setCellTemplate(new AW.Templates.Checkbox, i);
//                    this.grid.setCellText(function(col, row){return this.getCellValue(col, row) ? "SI" : "NO"}, i);


//                    this.grid.setCellText("some text", i);
  //                  this.grid.setCellImage("favorites", i);
//                    this.grid.setCellValue(false, i);

                }

                columnHeaderFilter.onControlValidated = function(text,col,row){
                  var obj=this.$owner;
                      obj.clearSortModel();
                      obj.clearSelectionModel();

                      obj.filter(text,col);

                   obj.refresh();
                   try {
                     this.focus();
                     this.select();
                  }
                  catch(ex){
            //    alert(ex.message);
                 }
                  }

                this.grid.setColumnWidth(this.column[i].width*7,i);
                if (this.column[i].type=='readonly')
                        this.grid.setCellEditable(false, i);
                else
                        this.grid.setCellEditable(true, i);
                this.grid.getCellTemplate(i).setStyle('text-align', this.column[i].align);
//                this.grid.getCellTemplate(i).setStyle('background', this.column[i].bgcolor);

        }


        this.grid.executeQuery=function(nrows) {
            var startIndex=this.offset+this.pageno*this.rows;
            var sqlCmd=this.sqlCommand+this.getWhere()+this.getOrderBy();

                       this.dataTable.setRequestMethod("POST");
                       this.dataTable.setURL("../lib/server/omnisoftRequestData.php");
                       this.dataTable.setParameter("startIndex", startIndex);
                       this.dataTable.setParameter("rowCount", this.rows);
                       this.dataTable.setParameter("query",sqlCmd);
                       this.dataTable.request();



        }

        this.grid.filter=function(criterio,col) {
          this.setWhere('');
          var ncolumns=this.getColumnIndices().length;
          var i=0;
          var swhere='';
          for (i=1; i <=ncolumns ; i++)  {
             criterio=this.getHeaderTemplate(i,2).getContent("box/text").element().value;

             if (criterio!='') {

             swhere= (swhere=='')?  ' (': swhere+' and (';
             swhere+=this.SQLColumn[i];

           switch(criterio.charAt(0)){
             case '=':
             case '<':
             case '>':
              swhere=swhere+ ' '+ criterio.charAt(0);
              if (criterio.charAt(1)=='=' ||criterio.charAt(1)=='>')
                 swhere=swhere+ criterio.charAt(1)+'"'+criterio.substr(2,criterio.length)+'")';
              else
               swhere=swhere+ '"'+criterio.substr(1,criterio.length)+'")';

              break;
             case '(':
               var acriterio=criterio.split(",");
               var inicio=acriterio[0].substr(1,10);
               var fin=acriterio[1].substr(0,10);

               swhere=swhere+ " between '"+inicio+"' and '"+ fin+"')";
               break;
             default:
               swhere = swhere+ ' like "'+criterio+'%")' ;
             break;

           }
          }

          }
          this.offset=0;
          this.pageno=0;

                   this.setWhere(swhere);
          this.executeQuery(this.rows);

        }



        this.search=function() {
         var element;
         var fields;
         element=document.getElementById('searchFilter');
                  if (element.value!='') {
                   var swhere=' (';
                   for (var i=1; i < this.columnCount-1; i++)   {
                   fields=this.grid.getFields(i);
                   if (fields.type!='hidden' && fields.searchable==true)
                //   swhere=swhere +fields.columnName+' like "%'+element.value+'%"  or  ';
                     swhere=swhere +this.SQLColumn[i]+' like "'+element.value+'%"  or  ';

                   }
                   fields=this.grid.getFields(i);

                  // swhere=swhere +fields.columnName+' like "%'+element.value+'%"  )';
                   if (fields.type!='hidden')
                   swhere=swhere +this.SQLColumn[i]+' like "%'+element.value+'%"  )';
                   else swhere=swhere +this.SQLColumn[0]+' like "%'+element.value+'%"  )';

                   this.grid.setWhere(swhere);
                   }
                   else this.grid.setWhere('');
                   this.grid.offset=0;
                   this.grid.pageno=0;
                   this.grid.executeQuery(this.rows);


        }

        this.filterProcess=function() {

                 var keycode;
                 if (window.event) keycode = window.event.keyCode;
                 else if (e) keycode = e.which;
                      else return true;

                if (keycode == 13)
                    this.search();
                else
                return true;
         }

        this.grid.setColumnIndices(visibleColumns);
        //this.grid.setCellEditable(true);



        //this.grid.setColumnCount(visibleColumns.length);

        this.grid.setRowCount(this.rows);
        this.grid.setVirtualMode(false);
        this.grid.setFooterVisible(true);
        this.grid.setFooterCount(2);
        this.grid.setHeaderCount(3);


      	this.grid.setSize(this.width, this.height);

        // selector
        this.grid.setSelectorVisible(true);
	this.grid.setSelectorText(function(i){return (i+this.offset)+(this.rows*this.pageno)+1; });
	this.grid.setSelectorWidth(50);

        // multiple selection
       // this.grid.setSelectionMode("multi-row");

        this.grid.getHeadersTemplate().setClass("text", "wrap");

        this.grid.updateData=function(objForm,row) {
//          alert(row);
            //var ncolumns=this.getColumnIndices().length;
            var ncolumns=this.fields.length;
            var j=0;
            var found=false;

                 for (var i=0; i < ncolumns; i++) {
                   found=false;
                   j=0;
                    while (!found && j < objForm.length) {

                      if (this.getFields(i).columnName==objForm.elements[j].name) {
                          if (objForm.elements[j].className!='combobox')
                          this.setCellText(objForm.elements[j].value,i,row);
                          else  {
                            var texto=objForm.elements[j].options[objForm.elements[j].selectedIndex].text;
                          this.setCellText(texto,i,row);
                          }
                          found=true;
                      }
                       j++;
                    }
                 }
            this.refresh()
        }

        this.grid.onSelectorClicked = function(event, row) {
                // var sqlcmd=this.formularioEditor+"?dummy=1&action=edit&table=";
                 var sqlcmd=this.formularioEditor;
                 var ncolumns=this.fields.length-1;

                // alert(ncolumns);
                 var atributes='';
                 this.action='edit';
                 this.selectedRow=row;
                /* sqlcmd+=this.table+'&key='+this.key+'&row='+row;
                 for (var i=0; i < ncolumns; i++)
                   sqlcmd+='&'+this.getFields(i).columnName+'='+this.getCellText(i,row);
                   sqlcmd+='&'+this.getFields(ncolumns).columnName+'='+this.getCellText(ncolumns,row);
                   */
                   if (this.formularioEditor!='none') {
                   attributes='width='+this.eWidth+',height='+this.eHeight+',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no';
                   omnisoftNewWindow=window.open(sqlcmd,'',attributes);
                   if (window.focus) {omnisoftNewWindow.focus()}
                  }

         }

         this.grid.onRowAdded= function (row) {
            var sqlcmd="insert into  "+this.table+ "  ( ";
            var i=1;
            var ncolumns=this.getColumnIndices().length;
            for (; i <ncolumns ; i++)
            sqlcmd+=this.getFields(i).columnName+",";
            sqlcmd+=this.getFields(i).columnName+" ) values ( " ;

            for (i=1; i < ncolumns; i++)
            sqlcmd+='0,';
            sqlcmd+='0)';
            //alert(sqlcmd);
             this.requestData(sqlcmd);

           // this.refresh();
         }

         this.grid.onRowDeleted= function(row) {


         }

         this.grid.onHeaderClicked = function(event,index){

                  var idcheckbox=document.activeElement.getAttribute('id');
                  var objcheckbox='';

                     if (idcheckbox.substr(0,6)=='check_' ||idcheckbox.substr(0,7)=='filter_' ||idcheckbox.substr(0,9)=='operator_' || idcheckbox.substr(0,4)=='len_') {

                          return true;

                      }



                  var idcheckbox=document.getElementById('check_'+this.getFields(index).columnName);


                    var column=this.getFields(index);
                    var order= ' order by ';
                    var sqlCmd=this.sqlCommand;
                        order=order +  this.getSQLColumn(index)+ ' ' + ((this.sortDirection =='descending') || (this.sortDirection=='')? 'ASC' : 'DESC');
                        this.setOrderBy(order);
                        this.sortDirection=(this.sortDirection=='descending') ? 'ascending' : 'descending';
                        this.sortIndex=index;
                        sqlCmd=sqlCmd+this.whereclause+order;

                        //prompt ('test',sqlCmd);
                        var startIndex=this.offset+this.pageno*this.rows;
                           this.dataTable.setRequestMethod("POST");
                           this.dataTable.setURL("../lib/server/omnisoftRequestData.php");
                           this.dataTable.setParameter("startIndex", startIndex); //StartIndex
                           this.dataTable.setParameter("rowCount", this.rows);   // rowCount
                           this.dataTable.setParameter("query",sqlCmd);
                           this.dataTable.request();

                           return true;

          };



         this.insert=function() {
           if (this.grid.formulario=='none')   {
               this.grid.addRow();
               setTimeout(this.grid.refresh(),300);
           }
           else {
                 //var sqlcmd=this.grid.formulario+"?dummy=1&action=insert&table=";
                 var sqlcmd=this.grid.formulario;

                 var ncolumns=this.grid.getColumnIndices().length;
                 var atributes='';
                 this.grid.action='insert';
                 this.grid.selectedRow=this.grid.getRowCount()+1;

                // sqlcmd+=this.grid.table+'&key='+this.grid.key+'&row='+this.grid.getRowCount()+1;
                    attributes='width='+this.grid.sWidth+',height='+this.grid.sHeight+',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no';
                  omnisoftNewWindow=  window.open(sqlcmd,'',attributes);
                    if (window.focus) {omnisoftNewWindow.focus()}

           }
         }

          this.edit=function() {
            if (this.grid.getSelectedRows()=='') {
             alert('Por favor seleccione un registro para editarlo');
             return;
            }
           if (this.grid.formularioEditor=='none')
               alert('Advertencia: El diseño del sistema no tiene asociado un formulario de edicion');
           else {
                // var sqlcmd=this.grid.formularioEditor+"?dummy=1&action=edit&table=";
                 var sqlcmd=this.grid.formularioEditor;
                 var ncolumns=this.grid.fields.length-1;
                    this.grid.action='edit';

                // alert(ncolumns);
                 var atributes='';
                 var row=this.grid.getSelectedRows();
                 this.grid.selectedRow=row;

                /* sqlcmd+=this.grid.table+'&key='+this.grid.key+'&row='+row;
                 for (var i=0; i < ncolumns; i++)
                   sqlcmd+='&'+this.grid.getFields(i).columnName+'='+this.grid.getCellText(i,row);
                   sqlcmd+='&'+this.grid.getFields(ncolumns).columnName+'='+this.grid.getCellText(ncolumns,row);
                   */
                   attributes='width='+this.grid.eWidth+',height='+this.grid.eHeight+',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no';
                  // prompt('test',sqlcmd);
                  omnisoftNewWindow= window.open(sqlcmd,'',attributes);
           }
         }





         this.erase=function() {
            if (this.grid.getSelectedRows()=='') {
             alert('Por favor seleccione un registro para eliminarlo');
             return;
            }
         var rowno=this.grid.getSelectedRows();

          if (confirm('Desea elimnar el (los) registro(s)?'))       {
         var sqlcmd="delete from "+this.table+ " where " +this.grid.getFields(0).columnName+"="+this.grid.getCellText(0,rowno);

             this.grid.requestData(sqlcmd,true);

          }

         }

         this.pdf=function() {
            var attributes='';
            var sQuery=this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy();
            var sWidth=1000;
            var sHeight=750;
            var sFields='';
            var fields;
            var item;
            var elem;
            var len=0;
            var orientation='L';
             if (window.screen) {
                 sWidth=window.screen.availWidth;
                 sHeight=window.screen.availHeight;
             }

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no');
               for (var i=1; i < this.columnCount; i++)   {
                      fields=this.grid.getFields(i);
                      item='check_'+fields.columnName;
                      elem=document.getElementById(item);
                   if (fields.type!='hidden'  && elem.checked) {
                      item='len_'+fields.columnName;
                      elem=document.getElementById(item);
                      len=len+parseInt(elem.value);

                   sFields=sFields +fields.label+'~'+fields.columnName.toLowerCase()+'~'+parseInt(elem.value)+'|';
                   }
                   }


               document.formParameters.query.value=sQuery;
               document.formParameters.fields.value=sFields;
               document.formParameters.orientation.value=(len>100)? 'L':'P';
               document.formParameters.title.value=this.rTitle;
               document.formParameters.target='javascript:window.open(\'../lib/export/omnisoftPDFApp.php\',\'omnisoftPDF\',\''+attributes+'\')';
               document.formParameters.action='../lib/export/omnisoftPDFApp.php';
               document.formParameters.submit();



         }

         this.graph=function() {
            var attributes='';
            var sURL='../lib/charts/grafico.html?dummy=1&query='+this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy()+'&fields=';
            var sWidth=680;
            var sHeight=520;
            var sFields='';
            var fields;
            var sQuery=this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy();
            var item;
            var elem;


            for (var i=1; i < this.columnCount; i++)   {
                 fields=this.grid.getFields(i);
                 item='check_'+fields.columnName;
                 elem=document.getElementById(item);
                 if (fields.type!='hidden'  && elem.checked)
                     if (fields.columnTable!='')
                   sFields=sFields +fields.label+'~'+fields.columnTable+'.'+fields.columnName.toLowerCase()+'|';
                   else
                   sFields=sFields +fields.label+'~'+fields.columnName.toLowerCase()+'|';

            }
               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no');

               document.formParameters.query.value=sQuery;
               document.formParameters.fields.value=sFields;
               document.formParameters.target='javascript:window.open(\'../lib/charts/grafico.html\',\'omnisoftGraph\',\''+attributes+'\')';
               document.formParameters.action='../lib/charts/grafico.html';
               document.formParameters.submit();

         }



         this.excel=function() {
            var attributes='';
            var sQuery=this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy();
            var sWidth=1000;
            var sHeight=750;
            var sFields='';
            var fields;
            var item;
            var elem;

             if (window.screen) {

                 sWidth=window.screen.availWidth;
                 sHeight=window.screen.availHeight;
             }

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=yes,location=no,status=no,menubar=yes');
              for (var i=1; i < this.columnCount; i++)   {
                 fields=this.grid.getFields(i);
                 item='check_'+fields.columnName;
                 elem=document.getElementById(item);
                 if (fields.type!='hidden'  && elem.checked)
                   sFields=sFields +fields.label+'~'+fields.columnName.toLowerCase()+'|';
              }

               document.formParameters.query.value=sQuery;
               document.formParameters.fields.value=sFields;
               document.formParameters.target='javascript:window.open(\'../lib/export/omnisoftExcelApp.php\',\'omnisoftExcel\',\''+attributes+'\')';
               document.formParameters.action='../lib/export/omnisoftExcelApp.php';
               document.formParameters.submit();


         }

         this.xml=function() {
            var attributes='';
            var sQuery=this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy();
            var sWidth=1000;
            var sHeight=750;
            var fields;
             if (window.screen) {
                 sWidth=window.screen.availWidth;
                 sHeight=window.screen.availHeight;
             }

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=yes,location=no,status=no,menubar=yes');

               document.formParameters.query.value=sQuery;
               document.formParameters.target='javascript:window.open(\'../lib/export/omnisoftXMLApp.php\',\'omnisoftXML\',\''+attributes+'\')';
               document.formParameters.action='../lib/export/omnisoftXMLApp.php';
               document.formParameters.submit();

         }


         this.mail=function() {
            var attributes='';
//            var sURL='../lib/export/omnisoftMailerApp.php?query='+this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy()+'&fields=';
            var sQuery=this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy();
            var sWidth=600;
            var sHeight=200;
            var sFields='';
            var fields;
            var item;
            var elem;

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no');

              for (var i=1; i < this.columnCount; i++)   {
                 fields=this.grid.getFields(i);

                 item='check_'+fields.columnName;
                 elem=document.getElementById(item);
                 if (fields.type!='hidden'  && elem.checked)
                   sFields=sFields +fields.label+'~'+fields.columnName.toLowerCase()+'|';
              }
               document.formParameters.query.value=sQuery;
               document.formParameters.fields.value=sFields;
               document.formParameters.target='javascript:window.open(\'../lib/export/omnisoftMailerApp.php\',\'omnisoftMailer\',\''+attributes+'\')';
               document.formParameters.action='../lib/export/omnisoftMailerApp.php';
               document.formParameters.submit();



//               sURL=sURL+sFields;
//               omnisoftNewWindow=window.open(sURL,'Mailer',attributes);
//               if (window.focus) {omnisoftNewWindow.focus()}

         }



         this.excelXLS=function() {
             if (window.ActiveXObject){

             var xlApp = new ActiveXObject("Excel.Application");
             var xlBook = xlApp.Workbooks.Add();
                 xlBook.worksheets(1).activate;
             var XlSheet = xlBook.activeSheet;
                 xlApp.visible = true;
                 var cols=this.grid.getColumnIndices();
                 for (var P=0; P < cols.length; P++) {
                    XlSheet.cells(1,P+1).font.bold=true;
                    XlSheet.cells(1,P+1).value = this.grid.getHeaderText(cols[P]);
                 }
                for (var i = 0; i < this.grid.getRowCount(); i++)
                  for (var j = 0; j <= cols.length; j++)

                      XlSheet.cells(i+3,j+1).value = this.grid.getCellText  (cols[j],i);


                XlSheet.columns.autofit;
                XlSheet.Name="Omnisoft";
             }
         }


       this.processPage=function() {
            var startIndex=this.grid.offset+this.grid.pageno*this.grid.rows;
            var order=this.grid.getOrderBy();
            var sqlCmd=this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy();
//            alert(this.grid.sqlCommand);
//            alert(sqlCmd);
//            alert(this.sqlCommand);

            this.grid.dataTable.setRequestMethod("POST");
            this.grid.dataTable.setURL("../lib/server/omnisoftRequestData.php");
            this.grid.dataTable.setParameter("startIndex", startIndex); //StartIndex
            this.grid.dataTable.setParameter("rowCount", this.grid.rows);   // rowCount
            this.grid.dataTable.setParameter("query",sqlCmd);
            this.grid.dataTable.request();
            var totalPages=parseInt(this.grid.getTotalRows()/this.rows);
            if (this.grid.getTotalRows()%this.rows)
            totalPages++;
            document.getElementById('pageLabel').innerHTML = "Página " + (this.grid.pageno + 1) + " de " + totalPages + "| Registros "+this.grid.getTotalRows();



       }
       this.firstPage=function() {
            this.grid.pageno=0;
            this.grid.offset=0;
            this.processPage();


       }

       this.previousPage=function() {
            if (this.grid.pageno>0) this.grid.pageno--;
            this.processPage();

       }

       this.nextPage=function() {
            var totalPages=parseInt(this.grid.getTotalRows()/this.rows);

            if (this.grid.pageno<totalPages)
               this.grid.pageno++;
            this.processPage();

       }

       this.lastPage=function() {
            var totalPages=parseInt(this.grid.getTotalRows()/this.rows);
            this.grid.pageno=totalPages;
            this.processPage();

       }


        var defaultEventHandler = this.grid.getEvent("onkeydown");
             this.grid.setEvent("onkeydown", function(e){
             var curRow=0;
             var loading=false;
             var elem=document.activeElement.getAttribute('id');
             if (elem.substr(0,7)=='filter_')   {

               return true;
             }
        if (e.keyCode==33 ||  e.keyCode==34 || e.keyCode==38 ||  e.keyCode==40) {
           var totalPages=parseInt(this.getTotalRows()/this.rows);

        if(e.keyCode==34){ // Page Down

            if (this.pageno<totalPages)
               this.pageno++;

             loading=true;

        }
        else if(e.keyCode==33){ // Page Up

           if (this.pageno>0) {
            this.pageno--;
            loading=true;
            }
            else if (this.offset!=0) {
                  this.offset=0;
                  loading=true;
                 }

        }
        else if(e.keyCode==38){ // up key

          curRow=this.getCurrentRow();
            if (curRow==0) {
            if (((this.offset-1)+this.pageno*this.rows)>=0) {
                this.offset--;
                loading=true;

            if (this.offset==-(this.rows-1)){
                if (this.pageno>0) this.pageno--;
                else loading=false;
                this.offset=0;
             }
             }
            }


        }
        else if(e.keyCode==40){ // down key

            curRow=this.getCurrentRow();

            if (curRow==(this.rows-1)) {
            this.offset++;
                loading=true;

            if (this.offset==(this.rows-1)){
                this.pageno++;
                this.offset=0;
             }
            }

            // move the selection down 1 cell
        }

            if (loading) {
            var startIndex=this.offset+this.pageno*this.rows;
            var order=this.getOrderBy();
            var sqlCmd=this.sqlCommand+this.getWhere()+this.getOrderBy();


            this.dataTable.setRequestMethod("POST");
            this.dataTable.setURL("../lib/server/omnisoftRequestData.php");
            this.dataTable.setParameter("startIndex", startIndex); //StartIndex
            this.dataTable.setParameter("rowCount", this.rows);   // rowCount
            this.dataTable.setParameter("query",sqlCmd);
            this.dataTable.request();

            }

        }

            //defaultEventHandler.call(this, event);
    } );


          this.initData(this.grid,this.sqlCommand,this.rows);
          this.grid.setCellModel(this.grid.dataTable);
        document.write(this.grid);
        document.write('<table background="../images/bg_blue.jpg" width="100%"> ');
        document.write('<tr height="25" ><td><table><tr><td>');

        document.write('<a href="javascript:'+gridName+'.firstPage();"><img align="top" src="../images/inicio.gif" alt="Inicio"  /></a>');
        document.write('<a href="javascript:'+gridName+'.previousPage();"><img align="top" src="../images/anterior.gif" alt="Anterior"  /></a>');
        document.write('<a href="javascript:'+gridName+'.nextPage();"><img align="top" src="../images/siguiente.gif" alt="Siguiente"  /></a>');
        document.write('<a href="javascript:'+gridName+'.lastPage();"><img align="top" src="../images/ultimo.gif" alt="Fin"  /></a>');
        document.write('</td>');
        document.write('<td width=600px><font size="-1">Buscar:</font><input type="text" name="searchFilter" id="searchFilter" maxlength="255" size="120"  onKeyPress="'+gridName+'.filterProcess();"></td>');
        document.write('<td width=180px><font size="-2"><span   id="pageLabel" align="right"></span></font></td></tr></table>');
        document.write('</td></tr>');
        document.write('<tr height="25" ><td class=menuborder><center><table><tr>');


//        document.write('<div class="dock" id="dock2">');
//        document.write('<div class="dock-container2">');
        if (this.buttons[0])
	document.write('<td width=70> <a href="javascript:'+gridName+'.insert();" onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Insertar Registro\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'"><img src="../images/insertar.png" alt="Insertar" width=48 height=48 /></a></td>');
        if (this.buttons[1])
	document.write('<td width=70><a  href="javascript:'+gridName+'.edit();"><img src="../images/editar.png" alt="Editar" width=48 height=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Editar Registro\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'" /></a></td>');
        if (this.buttons[2])
 	document.write('<td width=70><a href="javascript:'+gridName+'.erase();"><img src="../images/eliminar.png" alt="eliminar" width=48 height=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Eliminar Registro\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'" /></a></td>');
	document.write('<td width=70><a href="javascript:'+gridName+'.mail();"><img src="../images/correo.png" alt="Correo" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Enviar por correo\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'" /></a></td>');
 	document.write('<td width=70><a href="javascript:'+gridName+'.graph();"><img src="../images/graficar.png" alt="graficar" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Graficar datos\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'"/></a></td>');
	document.write('<td width=70><a href="javascript:'+gridName+'.pdf();"><img src="../images/imprimir.png" alt="imprimir" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Imprimir lista\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'" /></a></td> ');
        document.write('<td width=70><a href="javascript:'+gridName+'.xml();"><img src="../images/xml.png" alt="xml" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Exportar a XML\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'" /></a></td>');
        document.write('<td width=70><a href="javascript:'+gridName+'.excel();"><img src="../images/excel.png" alt="excel" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Exportar a Excel\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'" /></a></td>');
	document.write('<td width=70><a href="#"><img src="../images/ayuda.png" alt="ayuda" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Ayuda\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'"/></a></td>');
//	document.write('<a href="#"><img src="../images/acerca.png" alt="acerca de Ingenium" width=48 hight=48 /></a>');
	document.write('<td width=70><a href="../modulos/modulos.html"><img src="../images/home.png" alt="home" width=48 hight=48 onmouseover="document.getElementById(\'_spanAction\').innerHTML=\'Modulos\'" onmouseout="document.getElementById(\'_spanAction\').innerHTML=\' \'"/></a></td>');
	document.write('<td width=130><span id="_spanAction" class="tituloAccion"></span></td>');

//        document.write('  </div>');
//        document.write('</div>');

//        document.write('</td>');
        document.write('</tr></table></center></tr></table>');



     //   setTimeout(gridName+'.globalSummary()',300);

/*              	$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 75,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 75,
					proximity: 1,
					alignment : 'center',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

*/
        document.write('<div style="display:none"><form name="formParameters" method="POST" enctype="multipart/form-data" target="javascript:omnisoftPopUpWindow(\'pagina.html\')" > ');
        document.write('<input type="hidden" name="query" id="query">');
        document.write('<input type="hidden" name="fields" id="fields">');
        document.write('<input type="hidden" name="orientation" id="orientation">');
        document.write('<input type="hidden" name="title" id="title">');

        document.write('</form></div>');

   }

 // add columns

   this.addColumn = function(aLabel,aColumnName, aWidth,aType,aList,aAlign,aBGColor,aColumnTable,aSearchable) {

        var item=new Array();

        item.label=aLabel;
        item.columnName=aColumnName;
        item.width=aWidth;
        item.type=aType;
        item.list=aList;
        item.align=aAlign;
        item.bgcolor=aBGColor;
        item.columnTable=(aColumnTable==undefined)?'':aColumnTable;
        item.searchable=(aSearchable!=undefined || aSearchable==false || aType=='computed')?false:true;


        this.column[this.columnCount++]=item;
        this.grid.columnCount++;



   }

   this.grid.requestData=function(sqlcmd,ref) {
        var r = new AW.HTTP.Request;
        var errorMsg='';
        r.grid=this;
         var ref=(ref==undefined)?false:true;


        r.setURL("../lib/server/omnisoftDataManager.php");

        r.setRequestMethod("POST");
        r.setParameter("query",sqlcmd);
        //alert(sqlcmd);
        r.request();


        r.response = function(data){
//          alert(data);
           var datos=data.split('|');

           var msg=datos[0];

           if (msg!='') {
              alert(msg);
              errorMsg=msg;
           }
           else
                  if (datos[1]!=0)  {
                    var indexRow = this.grid.getRowCount()-1;
                  this.grid.setCellText(datos[1],0,indexRow);
                  }
                  else
                       if (ref==true)
                           this.grid.executeQuery(this.grid.rows);

        }
        return errorMsg;
   }

      this.grid.requestSummary=function(sqlcmd) {

        var r = new AW.HTTP.Request;
        var errorMsg='';
        var grids=this;

        r.setURL("../lib/server/omnisoftDataSummary.php");

        r.setRequestMethod("POST");
        r.setParameter("query",sqlcmd);
        r.request();


        r.response = function(data){
          var idx=1;
           var datos=data.split('|');
           var msg=datos[0];
           var result=datos[1].split('~');
           if (msg!='')
              errorMsg=msg;
           else {
                 grids.setTotalRows(result[0]);
                 var indices= grids.getColumnIndices();
                 for (var c=0;c<indices.length;c++)
           if ( grids.getFields(indices[c]).list!='' && (grids.getFields(indices[c]).type=='integer' ||grids.getFields(indices[c]).type=='double' || grids.getFields(indices[c]).type=='readonly' || grids.getFields(indices[c]).type=='computed')) {
              	    var stotal=parseFloat(result[idx++]).toFixed(2).toString();
                    grids.getFooterTemplate(indices[c],1).setStyle('text-align', 'right');
                    grids.setFooterText( formatDouble(stotal),indices[c],1);
                    grids.setFooterText("Subtotal",1,0);
                    grids.setFooterText("Total",1,1);

                    grids.getFooterTemplate(indices[c], 1).refresh();

           }
            grids.getFooterTemplate(1, 0).refresh();
            grids.getFooterTemplate(1, 1).refresh();




            var totalPages=parseInt(grids.getTotalRows()/grids.rows);
            if (grids.getTotalRows()%grids.rows)
            totalPages++;
            document.getElementById('pageLabel').innerHTML = "Página:" + (grids.pageno + 1) + " de " + totalPages + "| Registros:"+grids.getTotalRows();

           }
          }


        return errorMsg;
       }







       this.grid.onCurrentRowChanging= function( row){

        // alert('fila cambiada='+row);
      }

    this.grid.cellComboBoxValidation=function(text,column,row) {
       var grids=this;
       var txtValue='';
       var elem=this.getCellTemplate(column,row).element();
       grids.setAutoSuggest(false);

       	var options = {
		script:'../lib/autosuggest2/data.php?json=true&query="'+grids.getFields(column).list[0]+'"&',
		varname:"input",
		json:true,
		shownoresults:false,
		timeout:360000,
		callback: function (obj) {
                         var col=grids.getFieldByColumnName(grids.getFields(column).list[1]);
                          if (col<0)
                             col=column;
                             grids.setCellText( obj.id,col,row);
                             grids.setCellText( obj.value,column,row);
                          var sqlcmd="update "+grids.table+ " set ";
                          sqlcmd+=grids.getFields(col).columnName+"='"+obj.id+"' where ";
                          sqlcmd+=grids.getFields(0).columnName+"="+grids.getCellText(0,row);
                          grids.setAutoSuggest(true);
                          grids.requestData(sqlcmd,true);
           }
	};

	var as_json = new bsn.AutoSuggest(elem.id, options,column,row,this);

    }

    this.grid.cellDateValidation=function(text,column,row) {
       var test=this;
       var txtValue='';

       var onSelect = function(calendar, date){

                       if(calendar.dateClicked){
                          test.setCellText(date, column, row);
                          txtValue=date;
                          calendar.callCloseHandler();

            var sqlcmd="update "+test.table+ " set ";
            sqlcmd+=test.getFields(column).columnName+"='"+date+"' where ";
            sqlcmd+=test.getFields(0).columnName+"="+test.getCellText(0,row);
            test.requestData(sqlcmd);
                                          // var elem=test.getCellTemplate(column,row).element();
                                           // elem.blur();
                                          //test.getCellTemplate(column, row).refresh();

            }
       }
            var onClose = function(calendar){calendar.hide();calendar.destroy();}
            var cal = new Calendar(1, null, onSelect, onClose);
                      cal.weekNumbers = false;
                      cal.setDateFormat("%Y-%m-%d");
                      cal.create();
                       var elem=this.getCellTemplate(column,row).element();

                       cal.parseDate(this.getCellText(column,row));
                       cal.showAtElement(elem);

    }

    this.grid.onCellValidated = function(text, column, row){
                var fields= this.getFields(column);
        if (fields.type=='date')

                  if (!isDate(text)) {
                     this.cellDateValidation(text,column,row);
                     return true;
                  }


    }
    this.grid.onCellValueChanged = function(value, column, row){
             if (column!=undefined) {
                var fields= this.getFields(column);


                if (fields.type=='checkbox') {
                    var valor=(value==true)? "SI": "NO";
                    var sqlcmd="update "+this.table+ " set ";
                        sqlcmd+=this.getFields(column).columnName+"='"+valor+"' where ";
                        sqlcmd+=this.getFields(0).columnName+"="+this.getCellText(0,row);
                       this.requestData(sqlcmd);

                }
             }
    }

    this.grid.onCellValidating = function(text, column, row){

                var fields= this.getFields(column);
                var test=this;

                var txtValue='';

                switch(fields.type) {

                 case 'integer':
                 case 'double':
                  if (!isNumber(text)) {

                     alert('Error: Numero no valido!');
                    return "error";
                  }

                break;


                 case 'email':

                  if (!isEmail(text)) {

                     alert('Error: Correo electronico no valido!, por favor ingrese el correo en este formato => nombre@empresa.com');
                     test.setCellText('nombre@empresa.com',column,row);
                    return "error";
                  }
                break;


                 case 'hour':

                  if (!isHour(text)) {

                     alert('Error: Hora no valida!, por favor ingrese su hora en este formato => hh:mm:ss');
                     test.setCellText('00:00:00',column,row);
                    return "error";
                  }
                break;


                case 'combobox' :
                  if (text.length<3) {    // && !validateComboBox(text)) {
                    alert('Por favor seleccione un item de la lista o escriba al menos 3 letras');
                     test.cellComboBoxValidation(text,column,row);
                     return "error";
                  }
                  break;


                  break;

                }

                  txtValue=this.getCellText(0,row);
        if (fields.type!='combobox' && fields.type!='date') {
        var sqlcmd="update "+this.table+ " set ";
            sqlcmd+=this.getFields(column).columnName+"='"+this.getCellText(column,row)+"' where ";
            sqlcmd+=this.getFields(0).columnName+"="+this.getCellText(0,row);
           // alert(sqlcmd);

            this.requestData(sqlcmd);
        }

    }

    this.grid.onCellEditStarted = function(text, column, row){
     if ( this.getFields(column).type=='combobox')
        this.cellComboBoxValidation(text,column,row);
    }


    this.grid.onCellEditEnded = function(text, column, row){
          var total = 0;
     if ( this.getFields(column).type=='integer' ||this.getFields(column).type=='double')  {
      if (this.getFields(column).list=='sum')
          for (var i=0;i<this.getRowCount();i++)
                total += (this.getFields(column).type=='integer')?parseInt(this.getCellText(column, i)):parseFloat(this.getCellText(column, i));
      else
      if (this.getFields(column).list=='count')
         total= this.getRowCount();
      else
      if (this.getFields(column).list=='avg') {
          for (var i=0;i<this.getRowCount();i++)
               total +=  (this.getFields(column).type=='integer')?parseInt(this.getCellText(column, i)):parseFloat(this.getCellText(column, i));
             total=total/this.getRowCount();
          }

         this.setFooterText(total, column,0);
         this.getFooterTemplate(column, 0).refresh();

     }

   }

   this.grid.summary=function(columnCount) {
          var total=0;
          var list='';
          for (var c=0;c<columnCount;c++)    {

              list=(isArray(this.getFields(c).list))?this.getFields(c).list[0]:this.getFields(c).list;
           if ( list=='sum' ||list=='avg'||list=='count') {
            total=0;
            switch(list) {
              case 'sum':
               for (var i=0; i < this.getRowCount() ; i++)
               total += (this.getCellText(c, i)=='' || isNaN(this.getCellText(c, i))) ?0:parseFloat(this.getCellText(c, i));
                  break;
              case 'avg':
               for (var i=0; i < this.getRowCount() ; i++)
               total +=  (this.getCellText(c, i)=='' || isNaN(this.getCellText(c, i)))  ?0:parseFloat(this.getCellText(c, i));
               total=total/this.getRowCount();

                  break;
              case 'count':
                             total= this.getRowCount();
                  break;
           }

       		    var stotal=total.toFixed(2).toString();
                    this.getFooterTemplate(c,0).setStyle('text-align', 'right');
                    this.setFooterText(formatDouble(stotal), c,0);
                    this.getFooterTemplate(c, 0).refresh();
          }
       }

   }


   this.grid.globalSummary=function() {
          var sqlcmd='select count(*)';
          var whereclause='';
          var list='';
          for (var c=0;c<this.columnCount;c++)  {
              list=isArray(this.getFields(c).list)?this.getFields(c).list[0]:this.getFields(c).list;
            switch(list) {
              case 'sum':
                if (isArray(this.getFields(c).list))
                    sqlcmd+=',sum('+this.getFields(c).list[1]+')';
                else
                   sqlcmd+=',if('+this.SQLColumn[c]+' is NULL,0,sum('+this.SQLColumn[c]+'))';
                  break;
              case 'avg':
                if (isArray(this.getFields(c).list))
                    sqlcmd+=',avg('+this.getFields(c).list[1]+')';
                else
                sqlcmd+=',if('+this.SQLColumn[c]+' is NULL,0,avg('+this.SQLColumn[c]+'))';

                  break;

              case 'count':

                if (isArray(this.getFields(c).list))
                    sqlcmd+='count('+this.getFields(c).list[1]+')';
                else
                sqlcmd+='if('+this.SQLColumn[c]+' is NULL,0,count('+this.SQLColumn[c]+'))';

                  break;


           }
          }
       
          fromclause= this.sqlCommand.split('from')[1].split('where')[0];

           sqlcmd+=' from '+ fromclause ;
           whereclause=this.sqlCommand.split('where')[1];
          if (this.getWhere()=='')
          sqlcmd+=(whereclause==undefined)?'':' where '+ whereclause;
          else
            sqlcmd+=(whereclause==undefined)?this.getWhere():' where ' +whereclause+this.getWhere();
          this.requestSummary(sqlcmd);

   }




};


