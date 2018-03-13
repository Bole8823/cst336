<form>
    Name: <input type="text" id="Name" size="20" />   <br />
    Age: <input type="text" id="Age" size="20" />   <br />
    Comment:    <textarea id="comment" cols="30" rows="3"></textarea><br/><br />
    Favorite type of music: <br>
    <select id="music types">
      <option value="ALT">Alternative</option>
      <option value="BLU">Blues</option>
      <option value="CLA">Classical</option>
      <option value="COM">Commerciale</option>
      <option value="COU">Country</option>
      <option value="EXP">Experimental Rock</option>
      <option value="FOL">Folk Punk</option>
      <option value="HAR">Hard Rock</option>
      <option value="HIP">Hip Hop</option>
      <option value="RAP">RAP</option>
      <option value="SOU">Soul FC</option>
      <option value="REG">Reggae</option>
      
  </select>    <br /><br />
    Who is your favorite singer:    <br>
    <input type="radio"  id="item1"  name="degreeChoices"  value="High School" >
         <label for="item1">Prince</label> <br>
    <input type="radio"  id="item2"  name="degreeChoices" value="College">
          <label for="item2">Beyonce</label> <br><br>
    Where do you like listening musics :  <br> 
    <input type="checkbox" id="basket"  name="place" value="basket">
            <label for="basket"> Car </label> <br>
     <input type="checkbox" id="place" name="place" value="basket">
            <label for="place"> Home </label><br>
            <input type="checkbox" id="basket"  name="place" value="basket">
            <label for="basket"> Bus </label> <br>
     <input type="checkbox" id="place" name="place" value="basket">
            <label for="place"> Concert </label>
    <br/><br/>
    <input type="button" value="Submit" onclick="displayData()"/>
  </form>
 
