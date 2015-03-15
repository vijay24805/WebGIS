//compile this program using: javac proj2_readdata
//exectute this program and redirect the output to a sql file using: java proj2_readdata >nycgrid.sql
import java.io.*;
public class proj2_readdata
{
   public static void main (String args[]) throws Exception
  {

      	  String filename = "/Users/vvenkat000/Documents/nyccrash.txt";
          String sqlstr="CREATE TABLE \"nycgrid\" (gid serial PRIMARY KEY, \"crash_year\" numeric , \"accident_type\" numeric , \"collision_type\"  numeric, \"weather_condition\" numeric, \"light_condition\" numeric);";
          System.out.println(sqlstr);
		  String addgoemstr= "SELECT AddGeometryColumn('','nycgrid','the_geom','2263','POINT',2);";
		  System.out.println(addgoemstr);	
          BufferedReader fr = new BufferedReader(new FileReader(filename));
          String s=null;
		  
		  while ((s= fr.readLine()) != null)
          {
             String[] dat=s.split(",");   
			 
			 String crash_year = dat[0];
			 String accident_type  = dat[1];
			 String collision_type = dat[2];
			 String weather_condition  = dat[3];
			 String light_condition  = dat[4];
             String coorsx=dat[5]; //replace 0 with appropriate index
			 String coorsy=dat[6];
			 sqlstr= "insert into \"nycgrid\" (\"crash_year\", \"accident_type\", \"collision_type\", \"weather_condition\", \"light_condition\",the_geom) values ('"+crash_year+"','"+accident_type+"','"+collision_type+"','"+weather_condition+"','"+ light_condition+"',ST_GeomFromText('POINT("+ dat[5] + " " +  dat[6] +")',2263));";
			 System.out.println(sqlstr);
         }
         fr.close();
		  
		  
  }
}

