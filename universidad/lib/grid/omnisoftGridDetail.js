omnisoftGridDetail=function(aObjName, aMasterKey,aMasterKeyValue,aTable,aKey,aSQLCommand,aFormulario,abuttons,eformulario,eWidth,eHeight,aFunction) {

  // Database connectivity
   this.objName=aObjName;
   this.omnisoftRows=new Array();
   this.data=new Array();
   this.table=aTable;

   this.masterKey=aMasterKey;
   this.masterKeyValue=aMasterKeyValue;
   this.key=aKey;
   this.sqlCommand=aSQLCommand.toLowerCase();
   this.column=new Array();
   this.columnCount=0;
   this.SQLColumn=new Array();
   this.formulario=aFormulario;
   this.editorFormulario=(eformulario==undefined)? '':eformulario;
   this.eWidth=(eWidth==undefined)? 0:eWidth;
   this.eHeight=(eHeight==undefined)? 0:eHeight;
   this.funcion=(aFunction==undefined)?'':aFunction;
   this.buttons=(abuttons==undefined) ? Array(true,true): abuttons;

  // grid Object

    this.grid= new AW.Grid.Extended;
    this.grid.funcion=(aFunction==undefined)?'':aFunction;
    this.grid.setOffset=function(offset){this.offset=offset};
    this.grid.setPageNo=function(pageno){this.pageno=pageno};
    this.grid.setRange=function(min,max){this.minimo=min;this.maximo=max};
    this.grid.getMin=function(){return this.minimo};
    this.grid.getMax=function(){return this.maximo};
    this.grid.setCells=function(Cells) {this.cells=Cells;};
    this.grid.setMaxRows=function(rows) {this.rows=rows;};
    this.grid.setAutoSuggest=function(val){this.autoSuggest=val;};
    this.grid.getAutoSuggest=function(){return this.autoSuggest;};
    this.grid.formulario=aFormulario;
    this.grid.editorFormulario=(eformulario==undefined)? '':eformulario;
    this.grid.eWidth=(eWidth==undefined)? 0:eWidth;
    this.grid.eHeight=(eHeight==undefined)? 0:eHeight;

    this.grid.gridName='omniObj';
    this.grid.table=this.table;
    this.grid.key=this.key;
    this.grid.sqlCommand=this.sqlCommand;
    this.grid.orderby='';
    this.grid.whereclause='';
    this.grid.fields=this.fields;
    this.grid.action='';
    this.grid.selectedRow=0;

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
    this.grid.sortDirection='';
    this.grid.sortIndex=0;
    this.grid.sqlCommand=this.sqlCommand;
    this.grid.masterKey=aMasterKey;
    this.grid.masterKeyValue=aMasterKeyValue;
    this.grid.formulario=aFormulario;



 // grid format

   this.rows=12;
   this.height=228;
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
     // alert(data);
        if (!this._data.length){
            this._data = [];
        }


        var recs=data.split('|');
        var startIndex = Number(this._startIndexParameter);
        var rowCount = recs.length-2; //Number(this._rowCountParameter);
        window.status = "Datos cargados " + startIndex + "-" + (startIndex+rowCount);
        if (rowCount<0) rowCount=0;
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

    //var sqlaux=sqlCommand.split('masterkey')[0] +this.masterKeyValue+sqlCommand.split('masterkey')[1];
    var sqlaux=sqlCommand.replace(/masterkey/g,this.masterKeyValue);

 //   alert(sqlaux);
    grid.dataTable.setParameter("query",sqlaux);
    grid.dataTable.request();
}






 // show grid

   this.showGrid=function (gridName,pRows,pHeight,pWidth,pFont,pBGColor) {
        this.setSQLColumns();

        this.grid.setFields(this.column);
        this.grid.setSQLColumn(this.SQLColumn);
        this.grid.gridName=gridName;


        // grid format
        this.rows=pRows;
        this.height=pHeight;
        this.width=pWidth;
        this.font=pFont;
        this.bgcolor=pBGColor;

        // grid display functions

        var visibleColumns=new Array();
        var columnStyle='';
        for (var i=0,j=0; i < this.columnCount; i++) {

            if (this.column[i].type!='hidden')
                visibleColumns[j++]=i;



                this.grid.setHeaderText(this.column[i].label,i);
                this.grid.setHeaderHeight(30);
                this.grid.getHeadersTemplate().setClass("text", "wrap");
                this.grid.getHeadersTemplate().setStyle('text-align', 'center');

                this.grid.setColumnWidth(this.column[i].width,i);
               if (this.column[i].type=='readonly')
                        this.grid.setCellEditable(false, i);
                else
                        this.grid.setCellEditable(true, i);
               this.grid.getCellTemplate(i).setStyle('text-align', this.column[i].align);
//                this.grid.getCellTemplate(i).setStyle('background', this.column[i].bgcolor);


        }


        this.grid.executeQuery=function(nrows) {
            var startIndex=this.offset+this.pageno*this.rows;

                var sqlCmd=this.sqlCommand.replace(/masterkey/g,this.masterKeyValue);

           //alert(this.getWhere());
             sqlCmd=sqlCmd+this.getWhere()+this.getOrderBy();
//                      alert(sqlCmd);

                       this.dataTable.setRequestMethod("POST");
                       this.dataTable.setURL("../lib/server/omnisoftRequestData.php");
                       this.dataTable.setParameter("startIndex", startIndex);
                       this.dataTable.setParameter("rowCount", this.rows);
                       this.dataTable.setParameter("query",sqlCmd);
                       this.dataTable.request();
                       setTimeout(gridName+'.summary()',300);



        }

        this.search=function() {
         var element;
         var fields;
         element=document.getElementById('searchFilter');
                  if (element.value!='') {
                   var swhere=' (';
                   for (var i=1; i < this.columnCount-1; i++)   {
                   fields=this.grid.getFields(i);
                   if (fields.type!='hidden')
                //   swhere=swhere +fields.columnName+' like "%'+element.value+'%"  or  ';
                     swhere=swhere +this.SQLColumn[i]+' like "%'+element.value+'%"  or  ';

                   }
                   fields=this.grid.getFields(i);
                  // swhere=swhere +fields.columnName+' like "%'+element.value+'%"  )';
                   swhere=swhere +this.SQLColumn[i]+' like "%'+element.value+'%"  )';
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

//        this.grid.setFooterText('subtotal',1,0);
//        this.grid.setFooterText('hola',2,0);

//        this.grid.setFooterText('hola',1,1);


//     obj.getFooterTemplate(col, row).refresh();


      	this.grid.setSize(this.width, this.height);

        // selector
        this.grid.setSelectorVisible(true);
	this.grid.setSelectorText(function(i){return (i+this.offset)+(this.rows*this.pageno)+1; });
	this.grid.setSelectorWidth(50);

        // multiple selection
       // this.grid.setSelectionMode("multi-row");

        this.grid.getHeadersTemplate().setClass("text", "wrap");

        this.grid.updateData=function(objForm,row) {
//          (row);
            var ncolumns=this.getColumnIndices().length;

            var j=0;
            var found=false;

                 for (var i=0; i < ncolumns; i++) {
                   found=false;
                   j=0;
                    while (!found && j < objForm.length) {

                      if (this.getFields(i).columnName==objForm.elements[j].name) {
                          this.setCellText(objForm.elements[j].value,i,row);
                          found=true;
                      }
                       j++;
                    }
                 }
            this.refresh();

        }

        this.grid.onSelectorClicked = function(event, row) {
              if (this.editorFormulario!='') {
                 this.action='edit';
                 this.selectedRow=row;

                 var sqlcmd=this.editorFormulario+"?dummy=1&action=edit&table=";
                 var ncolumns=this.fields.length-1;
                 var atributes='';
                 sqlcmd+=this.table+'&key='+this.key+'&row='+row+'&'+this.masterKey+'='+this.masterKeyValue;
                 for (var i=0; i < ncolumns; i++)
                   sqlcmd+='&'+this.getFields(i).columnName+'='+this.getCellText(i,row);
                   sqlcmd+='&'+this.getFields(ncolumns).columnName+'='+this.getCellText(ncolumns,row);
                   attributes='width='+this.eWidth+',height='+this.eHeight+',scrollbars=no,resizable=no,toolbar=no,location=no,status=no,menubar=no';
                   window.open(sqlcmd,'',attributes);
              }

         }
         this.grid.onCellSelectedChanged=function(state,col,row) {
              if (state && this.funcion!='') {
                 var comando=this.funcion+"("+row+")";
                 eval(comando);

              }
         }
         this.grid.onRowAdded= function (row) {

            var masterresult='';
            var sqlcmd="insert into  "+this.table+ "  ( "+this.masterKey+",";

            var i=1;
            var ncolumns=this.fields.length-1;
           // alert(this.masterKeyValue);
            for (; i <ncolumns ; i++)
            if (this.getFields(i).type!='combobox' && this.getFields(i).type!='readonly' )
            sqlcmd+=this.getFields(i).columnName+",";

            sqlcmd+=this.getFields(i).columnName+" ) values ( " ;
            sqlcmd+=this.masterKeyValue+",";
            for (i=1; i < ncolumns; i++)
              if (this.getFields(i).type!='combobox' && this.getFields(i).type!='readonly')
                  sqlcmd+='\''+this.getFields(i).value+'\',';
            sqlcmd+='\''+this.getFields(i).value+'\')';
            sqlcmd=sqlcmd.toUpperCase();
            //alert(sqlcmd);
            setTimeout(this.requestData(sqlcmd),300);
            //alert(sqlcmd);
            // this.refresh();
         }

         this.grid.onRowDeleted= function(row) {


         }

         this.grid.onHeaderClicked = function(event,index){



                  //  var direccion  = this.getSortDirection(index);
                    var column=this.getFields(index);
                    var order= ' order by ';
//                    var sqlCmd=this.sqlCommand.split('masterkey')[0]+this.masterKeyValue+this.sqlCommand.split('masterkey')[1];
                    var sqlCmd=this.sqlCommand.replace(/masterkey/g,this.masterKeyValue);

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

                           //return true;

          };


        this.grid.formInsert=function() {
	var SQLCommand='';
	var SQLAction='';
	var table=top.opener.omniObj.grid.table;
	var row=top.opener.omniObj.grid.selectedRow;
	var resultData='';
	var objForm=this.formulario;
	table=table.replace('#',' ');
	var i=0;
	var nitems=objForm.length-1;

        SQLAction='insert into ';
 		SQLAction=SQLAction.concat(table,' (');

                if (document.getElementById('searchFilter'))
                   nitems-=2;

                for (i=2; i < nitems ; i++) {
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].name,',');
               }
		if (objForm.elements[i].type=='password' )
			SQLAction=SQLAction.concat(objForm.elements[i].name,") values (");
		else if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
			SQLAction=SQLAction.concat(objForm.elements[i].name,") values ('");
		else SQLAction=SQLAction.concat(") values ('");

		for (i=2; i < nitems; i++) {
			if (objForm.elements[i].type=='password' )
				SQLAction=SQLAction.concat("md5('",objForm.elements[i].value,"'),'");
			else if ((objForm.elements[i].className!='' ) &&  objForm.elements[i+1].type!='password' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].value,"','");
			else if (objForm.elements[i+1].type=='password')
				SQLAction=SQLAction.concat(objForm.elements[i].value,"',");
		}

		if (objForm.elements[i].type=='password' )
			SQLAction=SQLAction.concat('substring(md5(',objForm.elements[i].value,"'),1,10),'");
		else
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].value,"')");

                //alert(SQLAction);
                SQLAction=SQLAction.toUpperCase();
                setTimeout(this.requestData(SQLAction,true),300);
                this.executeQuery(grids.rows);


              }


         this.insert=function() {
              if (this.grid.editorFormulario!='') {
                this.grid.action='insert';

                 var sqlcmd=this.grid.editorFormulario+"?dummy=1&action=insert&table=";
                 var ncolumns=this.grid.fields.length-1;
                 var atributes='';
                 sqlcmd+=this.grid.table+'&'+this.grid.masterKey+'='+this.grid.masterKeyValue;
          //       for (var i=0; i < ncolumns; i++)
          //         sqlcmd+='&'+this.grid.getFields(i).columnName+'='+this.grid.getCellText(i,row);
          //         sqlcmd+='&'+this.grid.getFields(ncolumns).columnName+'='+this.grid.getCellText(ncolumns,row);
                   attributes='width='+this.grid.eWidth+',height='+this.grid.eHeight+',scrollbars=no,resizable=no,toolbar=no,location=no,status=no,menubar=no';
                   window.open(sqlcmd,'',attributes);
              }

           else
            if (this.grid.masterKeyValue!='')   {
                 this.grid.addRow();
                 this.grid.refresh();
            }

            else {
                         this.grid.formInsert();


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
         var errMsg ='';
         errMsg=setTimeout(this.grid.requestData(sqlcmd),300);
         if (errMsg==-1) {
             var rowCount=this.grid.getRowCount()-1;
             this.grid.executeQuery(this.rows);

             this.grid.setRowCount(rowCount);

             this.grid.refresh();

         }
        // else alert(errMsg);
          }
         }

         this.pdf=function() {
            var attributes='';
            var sURL='../lib/export/omnisoftPDFApp.php?query='+this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy()+'&fields=';
            var sWidth=1000;
            var sHeight=750;
            var sFields='';
            var fields;
             if (window.screen) {
                 sWidth=window.screen.availWidth;
                 sHeight=window.screen.availHeight;
             }

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no');
               for (var i=1; i < this.columnCount; i++)   {
                      fields=this.grid.getFields(i);
                   if (fields.type!='hidden')
                   sFields=sFields +fields.label+'~'+fields.columnName+'~'+fields.width+'|';
                   }
               sURL=sURL+sFields;
               omnisoftNewWindow=window.open(sURL,'PDF',attributes);
               if (window.focus) {omnisoftNewWindow.focus()}

         }


         this.excel=function() {
            var attributes='';
            var sURL='../lib/export/omnisoftExcelApp.php?query='+this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy()+'&fields=';
            var sWidth=1000;
            var sHeight=750;
            var sFields='';
            var fields;
             if (window.screen) {
                 sWidth=window.screen.availWidth;
                 sHeight=window.screen.availHeight;
             }

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no');
               for (var i=1; i < this.columnCount; i++)   {
                      fields=this.grid.getFields(i);
                   if (fields.type!='hidden')
                   sFields=sFields +fields.label+'~'+fields.columnName+'|';
                   }
               sURL=sURL+sFields;
               omnisoftNewWindow=window.open(sURL,'Excel',attributes);
               if (window.focus) {omnisoftNewWindow.focus()}

         }

         this.xml=function() {
            var attributes='';
            var sURL='../lib/export/omnisoftXMLApp.php?query='+this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy()+'&fields=';
            var sWidth=1000;
            var sHeight=750;
            var sFields='';
            var fields;
             if (window.screen) {
                 sWidth=window.screen.availWidth;
                 sHeight=window.screen.availHeight;
             }

               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=yes,resizable=yes,toolbar=no,location=no,status=no,menubar=no');

               omnisoftNewWindow=window.open(sURL,'XML',attributes);
               if (window.focus) {omnisoftNewWindow.focus()}

         }


         this.mail=function() {
            var attributes='';
            var sURL='../lib/export/omnisoftMailerApp.php?query='+this.grid.sqlCommand+this.grid.getWhere()+this.grid.getOrderBy()+'&fields=';
            var sWidth=600;
            var sHeight=200;
            var sFields='';
            var fields;
               attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=no,resizable=no,toolbar=no,location=no,status=no,menubar=no');
               for (var i=1; i < this.columnCount; i++)   {
                      fields=this.grid.getFields(i);
                   if (fields.type!='hidden')
                   sFields=sFields +fields.label+'~'+fields.columnName+'|';
                   }
               sURL=sURL+sFields;
               omnisoftNewWindow=window.open(sURL,'Mailer',attributes);
               if (window.focus) {omnisoftNewWindow.focus()}

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
//            var sqlCmd=this.grid.sqlCommand.split('masterkey')[0] +this.masterKeyValue+this.grid.sqlCommand.split('masterkey')[1];
            var sqlCmd=this.grid.sqlCommand.replace(/masterkey/g,this.masterKeyValue);


            sqlCmd=sqlCmd+this.grid.getWhere()+this.grid.getOrderBy();

            this.grid.dataTable.setRequestMethod("POST");
            this.grid.dataTable.setURL("../lib/server/omnisoftRequestData.php");
            this.grid.dataTable.setParameter("startIndex", startIndex); //StartIndex
            this.grid.dataTable.setParameter("rowCount", this.grid.rows);   // rowCount
            this.grid.dataTable.setParameter("query",sqlCmd);
            this.grid.dataTable.request();
            setTimeout(gridName+'.summary()',300);
            var totalPages=parseInt(this.grid.getTotalRows()/this.rows);
            if (this.grid.getTotalRows()%this.rows)
            totalPages++;
            document.getElementById('pageLabel').innerHTML = "Pág:" + (this.grid.pageno + 1) + " de " + totalPages + "| Regs:"+this.grid.getTotalRows();



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
        //    var totalPages=parseInt(this.grid.getTotalRows()/this.rows);
       //            if (this.grid.pageno<totalPages)
               this.grid.pageno++;
            this.processPage();

       }

       this.lastPage=function() {
            var totalPages=parseInt(this.grid.getTotalRows()/this.rows);
            this.grid.pageno=totalPages;
            this.processPage();

       }


//        var defaultEventHandler = this.grid.getEvent("onkeydown");
           var defaultEventHandler = this.grid.getEvent("onkeydown");

          //  defaultEventHandler.call(this.grid, event);



        this.grid.setEvent("onkeydown", function(e){
             var curRow=0;
             var loading=false;
//             alert(e.keyCode);

        if (e.keyCode==33 ||  e.keyCode==34 || e.keyCode==38 ||  e.keyCode==40) {
        if(e.keyCode==34){ // Page Down
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
//            var sqlCmd=this.sqlCommand.split('masterkey')[0]+this.masterKeyValue+this.sqlCommand.split('masterkey')[1];
            var sqlCmd=this.sqlCommand.replace(/masterkey/g,this.masterKeyValue);

            sqlCmd=sqlCmd+this.getWhere()+this.getOrderBy();
           // alert(sqlCmd);


            this.dataTable.setRequestMethod("POST");
            this.dataTable.setURL("../lib/server/omnisoftRequestData.php");
            this.dataTable.setParameter("startIndex", startIndex); //StartIndex
            this.dataTable.setParameter("rowCount", this.rows);   // rowCount
            this.dataTable.setParameter("query",sqlCmd);
            this.dataTable.request();
            setTimeout(gridName+'.summary()',300);

            }

        }
//           var defaultEventHandler = this.getEvent("onkeydown");

//            defaultEventHandler.call(this, event);
    } );


          this.initData(this.grid,this.sqlCommand,this.rows);
          this.grid.setCellModel(this.grid.dataTable);
        document.write(this.grid);
        document.write('<table background="../images/bg_blue.jpg" width="1020"> ');
        document.write('<tr height="25" ><td>');
        if (this.buttons[0])
            document.write('<a href="javascript:'+gridName+'.insert();"><img align="top" src="../images/insertar.gif" alt="Insertar"  /></a>');
        if (this.buttons[1])
            document.write('<a href="javascript:'+gridName+'.erase();"><img align="top" src="../images/eliminar.gif" alt="Eliminar"  /></a>');

        document.write('<a href="javascript:'+gridName+'.firstPage();"><img align="top" src="../images/inicio.gif" alt="Inicio"  /></a>');
        document.write('<a href="javascript:'+gridName+'.previousPage();"><img align="top" src="../images/anterior.gif" alt="Anterior"  /></a>');
        document.write('<a href="javascript:'+gridName+'.nextPage();"><img align="top" src="../images/siguiente.gif" alt="Siguiente"  /></a>');
        document.write('<a href="javascript:'+gridName+'.lastPage();"><img align="top" src="../images/ultimo.gif" alt="Fin"  /></a>');
        //document.write('</td></tr>');
        //document.write('<tr height="25" ><td>');
        document.write('<font size="-1">Buscar:</font><input type="text" name="searchFilter" id="searchFilter" maxlength="255" size="80" onKeyPress="'+gridName+'.filterProcess();">');
        document.write('<font size="-2"><span   id="pageLabel" align="right"></span></font>');


/*        document.write('<div class="dock" id="dock2">');
        document.write('<div class="dock-container2">');
//	document.write('<a class="dock-item2" href="javascript:'+gridName+'.insert();"><span>Insertar</span><img src="../images/insertar.png" alt="insertar"  /></a>');
//	document.write('<a class="dock-item2" href="javascript:'+gridName+'.edit();"><span>Editar</span><img src="../images/editar.png" alt="editar" /></a>');
// 	document.write('<a class="dock-item2" href="javascript:'+gridName+'.erase();"><span>Eliminar</span><img src="../images/eliminar.png" alt="eliminar" /></a>');
//	document.write('<a class="dock-item2" href="javascript:'+gridName+'.mail();"><span>Correo</span><img src="../images/correo.png" alt="correo" /></a>');
// 	document.write('<a class="dock-item2" href="#"><span>Graficar</span><img src="../images/graficar.png" alt="graficar" /></a>');
//	document.write('<a class="dock-item2" href="javascript:'+gridName+'.pdf();"><span>Imprimir</span><img src="../images/imprimir.png" alt="imprimir" /></a> ');
	//document.write('<a class="dock-item2" href="javascript:'+gridName+'.search();"><span>Buscar</span><img src="../images/buscar.png" alt="buscar" /></a>');
//        document.write('<a class="dock-item2" href="javascript:'+gridName+'.xml();"><span>Xml</span><img src="../images/xml.png" alt="xml" /></a>');
//        document.write('<a class="dock-item2" href="javascript:'+gridName+'.excel();"><span>Excel</span><img src="../images/excel.png" alt="excel" /></a>');
	document.write('<a class="dock-item2" href="#"><span>Ayuda</span><img src="../images/ayuda.png" alt="ayuda" /></a>');
	//document.write('<a class="dock-item2" href="#"><span>Acerca de</span><img src="../images/acerca.png" alt="acerca de" /></a>');
//	document.write('<a class="dock-item2" href="'+documentRoot+'/modulos.html"><span>Home</span><img src="../images/home.png" alt="home" /></a>');
	document.write('<a class="dock-item2" onclick="window.close()"><span>Home</span><img src="../images/home.png" alt="home" /></a>');

        document.write('  </div>');
        document.write('</div>');  */

        document.write('</td>');
        document.write('</tr></table>');

        setTimeout(gridName+'.globalSummary()',300);
        setTimeout(gridName+'.summary()',300);

/*              	$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 50,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 50,
					proximity: 3,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);  */



   }

 // add columns

   this.addColumn = function(aLabel,aColumnName, aWidth,aType,aList,aAlign,aBGColor,aValue,aRefresh) {

        var item=new Array();

        item.label=aLabel;
        item.columnName=aColumnName;
        item.width=aWidth*10;
        item.type=aType;
        item.list=aList;
        item.align=aAlign;
        item.bgcolor=aBGColor;
        item.value=(aValue==undefined)? '0':aValue;
        item.refresh=(aRefresh==undefined)? false:true;
        this.column[this.columnCount++]=item;
   }

   this.grid.requestData=function(sqlcmd,formulario) {
        var r = new AW.HTTP.Request;
        var errorMsg='';
        var formulario=(formulario==undefined)?false:true;
        r.grid=this;
       // r.setOwner(this);
        r.setURL("../lib/server/omnisoftDataManager.php");

        r.setRequestMethod("POST");
        r.setParameter("query",sqlcmd);
        r.request();


        r.response = function(data){
           var datos=data.split('|');
           var msg=datos[0];

           if (msg!='') {
              errorMsg=msg;
              alert(msg);
           }
           else
                  if (formulario==false) {
                  if (datos[1]!=0)  {
                    var indexRow = this.grid.getRowCount()-1;
                  // if (indexRow<0) {indexRow=0; this.grid.setRowCount(1);}
                  this.grid.setCellText(datos[1],0,indexRow);
                  this.grid.refresh();
                  }
                  }
                  else {
                          this.grid.masterKeyValue=datos[1];
                          this.grid.formulario.action.value='edit';
                          top.opener.omniObj.grid.action='edit';

                          this.grid.formulario.elements[1].value=datos[1];
                          this.grid.refresh();

                        }
        }
        return errorMsg;
   }

      this.grid.requestSummary=function(sqlcmd) {

        var r = new AW.HTTP.Request;
        var errorMsg='';
        var grids=this;
        r.grid=this;
        //r.setOwner(this);

        r.setURL("../lib/server/omnisoftDataSummary.php");

        r.setRequestMethod("POST");
        r.setParameter("query",sqlcmd);
        r.request();


        r.response = function(data){
          //alert(data);
          var idx=1;
           var datos=data.split('|');
           var msg=datos[0];
           var result=datos[1].split('~');
           if (msg!='')
              errorMsg=msg;
           else {
                 grids.setTotalRows(result[0]);
                 var indices=grids.getColumnIndices();

                 for (var c=0;c<indices.length;c++)
           if ( grids.getFields(indices[c]).list!='' && (grids.getFields(indices[c]).type=='integer' ||grids.getFields(indices[c]).type=='double' ||grids.getFields(indices[c]).type=='readonly')) {
                   	    var stotal=parseFloat(result[idx++]).toFixed(2).toString();
             //    grids.getFooterTemplate(indices[c],1).setStyle('text-align', 'right');

                    grids.setFooterText(formatDouble( stotal),indices[c],1);
                   grids.setFooterText("Subtotal",1,0);
                    grids.setFooterText("Total",1,1);

                    grids.getFooterTemplate(indices[c], 1).refresh();

           }

            grids.getFooterTemplate(1, 0).refresh();
            grids.getFooterTemplate(1, 1).refresh();




            var totalPages=parseInt(grids.getTotalRows()/grids.rows);
            if (grids.getTotalRows()%grids.rows)
            totalPages++;
            document.getElementById('pageLabel').innerHTML = "Pág:" + (grids.pageno + 1) + " de " + totalPages + "| Regs:"+grids.getTotalRows();

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

	//alert('../lib/autosuggest2/data.php?json=true&fieldname='+grids.getFields(column).list[2]+'&query="'+grids.getFields(column).list[0]+'"&');
       	var options = {
		script:'../lib/autosuggest2/data.php?json=true&fieldname='+grids.getFields(column).list[2]+'&query="'+grids.getFields(column).list[0]+'"&',
		varname:"input",
		json:true,
		shownoresults:true,
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
                         // alert(sqlcmd);
                           sqlcmd=sqlcmd.toUpperCase();
                           setTimeout(grids.requestData(sqlcmd),200);
                           grids.executeQuery(grids.rows);

                         //  grids.refresh();

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
            sqlcmd=sqlcmd.toUpperCase();
            //prompt('test',sqlcmd);
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
        if (fields.type=='date')   {
                  if (!isDate(text)) {
                     this.cellDateValidation(text,column,row);
                     return true;
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
                     test.setCellText('00:00:00',column,row);
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
                //  if (text.length<3) {    // && !validateComboBox(text)) {
                //    alert('Por favor seleccione un item de la lista o escriba al menos 3 letras');
                 //    test.cellComboBoxValidation(text,column,row);
                 //    return "error";
                 // }
                  break;


                  break;

                }

                  txtValue=this.getCellText(0,row);

        if (fields.type!='combobox' && fields.type!='date') {
        var sqlcmd="update "+this.table+ " set ";
            sqlcmd+=this.getFields(column).columnName+"='"+this.getCellText(column,row)+"' where ";
            sqlcmd+=this.getFields(0).columnName+"="+this.getCellText(0,row);
           sqlcmd=sqlcmd.toUpperCase();

          //  prompt('test=',sqlcmd);

       this.requestData(sqlcmd);
             if (fields.refresh==true) {
             setTimeout(this.requestData(sqlcmd),300);
                           this.executeQuery(this.rows);
             if (this.funcion!='')  {

             var comando=this.funcion+"()";
             eval(comando);
             }
                          this.refresh();
             }


        }
    }

    this.grid.onCellEditStarted = function(text, column, row){

     if ( this.getFields(column).type=='combobox')
        this.cellComboBoxValidation(text,column,row);
    }


    this.grid.onCellEditEnded = function(text, column, row){
          var total = 0;
     if ( this.getFields(column).list!='')  {
      if (this.getFields(column).list=='sum')
          for (var i=0;i<this.getRowCount();i++)
                total += parseFloat(this.getCellText(column, i));
      else
      if (this.getFields(column).list=='count')
         total= this.getRowCount();
      else
      if (this.getFields(column).list=='avg') {
          for (var i=0;i<this.getRowCount();i++)
               total +=  parseFloat(this.getCellText(column, i));
             total=total/this.getRowCount();
          }

          if (this.getFields(column).type=='double')
		      total=formatDouble(total);
         this.setFooterText(total, column,0);
         this.getFooterTemplate(column, 0).refresh();

     }

   }



   this.summary=function() {
          var total=0;
          for (var c=0;c<this.columnCount;c++)
           if ( this.grid.getFields(c).list=='sum' ||this.grid.getFields(c).list=='avg'||this.grid.getFields(c).list=='count') {
            total=0;
            switch(this.grid.getFields(c).list) {
              case 'sum':
               for (var i=0; i < this.grid.getRowCount() ; i++)
               total +=  parseFloat(this.grid.getCellText(c, i));
                  break;
              case 'avg':
               for (var i=0; i < this.grid.getRowCount() ; i++)
               total +=  parseFloat(this.grid.getCellText(c, i));
               total=total/this.grid.getRowCount();

                  break;
              case 'count':
                             total= this.grid.getRowCount();

                  break;


           }

       		    var stotal=total.toFixed(2).toString();
                    this.grid.getFooterTemplate(c,0).setStyle('text-align', 'right');

                    this.grid.setFooterText(formatDouble(stotal), c,0);
                    this.grid.getFooterTemplate(c, 0).refresh();


          }


   }


   this.globalSummary=function() {
          var sqlcmd='select count(*)';
          var whereclause='';
          for (var c=0;c<this.columnCount;c++)
            switch(this.grid.getFields(c).list) {
              case 'sum':
                //alert(this.SQLColumn[c]);
                sqlcmd+=',if('+this.SQLColumn[c]+' is NULL,0,sum('+this.SQLColumn[c]+'))';
                  break;
              case 'avg':
                sqlcmd+='if('+this.SQLColumn[c]+' is NULL,0,avg('+this.SQLColumn[c]+'))';

                  break;
              case 'count':
                sqlcmd+='if('+this.SQLColumn[c]+' is NULL,0,count('+this.SQLColumn[c]+'))';

                  break;


           }

         fromclause= this.grid.sqlCommand.split('from')[1].split('where')[0];

          sqlcmd+=' from '+ fromclause+ ' where '+this.masterKey+'='+this.masterKeyValue+' ';
           whereclause=this.grid.sqlCommand.split('where')[1];
           whereclause=whereclause=whereclause.replace(/masterkey/g,this.grid.masterKeyValue);

          if (this.grid.getWhere()=='')
             sqlcmd+=' and ' +whereclause;
          else sqlcmd+=this.grid.getWhere();
          //alert(sqlcmd);
          this.grid.requestSummary(sqlcmd);
   }




};


