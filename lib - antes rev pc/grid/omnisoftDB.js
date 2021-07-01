
omnisoftDB=function(aSQLCommand,aPath,aFunction) {

   this.sqlCommand=aSQLCommand.toUpperCase();
   this.dataTable='';
   this.rpath=(aPath==undefined)?"lib/server/omnisoftSQLData.php":aPath;
   this.rfunction =(aFunction==undefined)?'omnisoftProcesarDatos':aFunction;

this.executeQuery=function () {

         var funcion=this.rfunction;
         this.dataTable = new AW.HTTP.Request();
         this.dataTable.setRequestMethod("POST");
         this.dataTable.setURL(this.rpath);
         this.dataTable.setParameter("query",this.sqlCommand);
         this.dataTable.response = function(datos) {
         var comando=funcion+"('"+datos+"')";
           eval(comando);

        };
         this.dataTable.request();
  }
};


