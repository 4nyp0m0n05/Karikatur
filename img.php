<html>
<body>
	<form method="post" enctype="multipart/form-data">
	<br/>
		<input type="file" name="image"/>
		<br/>
		<br/>
		<input type="submit" name="submit" value="Upload"/>
		


	</form>
	<?php

		if(isset($_POST['submit'])){
			if(getimagesize($_FILES['image']['tmp-name'])){
				echo "Select image";			
			}
			else{
				$image=addslashes($_FILES['image']['tmp_name']);
				$name=addslashes($_FILES['image']['name']);
				$image=file_get_contents($image);
				$image=base64_encode($image);
				saveImage($name,$image);
                
			}
		}
        display();
        
		function saveImage($name,$image){
			$con=new mysqli();
			$qry="insert into (name,image) values ('$name','$image')";
			$res=$con->query($qry);
			if($res){
				echo "1";
			}
			else{
				echo "0";
			}
		
		}
function display(){
			$con=new mysqli();
			$qry="select * from  ";
			$res=$con->query($qry);
            if($res){
				echo "1";
			}
			else{
				echo "0";
			}
			while($row=mysqli_fetch_array($res)){
				echo '<img src="data:image;base64,'.$row[2].'">';
			}
			$con->close();
		}
			
	?>



</html>
