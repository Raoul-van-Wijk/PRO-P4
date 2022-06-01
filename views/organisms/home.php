<?php
$friends = new Chat($_SESSION['userID']);
$user = new Users();
$files = new Files($_SESSION['username']);

if(isset($_GET['friendID'])) { $userID = $_GET['friendID']; } 
else { $userID = $_SESSION['userID']; }

$currentUser = $user->getUserByID($userID);
$pfp = new ProfileCustomization($userID);
$currentProfile = $pfp->getUserProfile();
?>

<aside class="aside">
  <h2>List of friends</h2>
    <?php $friends = $friends->getFriends(); ?>
    <?php foreach($friends as $friend) : ?>
      <a href="home&friendID=<?php echo $friend['frID']; ?>">
        <?php echo $friend['username']; ?>
      </a>
    <?php endforeach; ?>

</aside>

<div class="profile">
<img class="banner" src="<?php echo $pfp->checkBanner($currentProfile[0]['backGroundImage']) ?>" alt="No img">
<div class="content">
  <img class="pfp" src="<?php echo $pfp->checkProfilePicture($currentProfile[0]['profilePicture']) ?>" alt="No img">
  <p><?php echo $currentUser[0]['username'] . ', ' . $currentUser[0]['age']; ?></p>
  <div class="row">
    <div class="bio"><p><?php echo $currentProfile[0]['bio']; ?>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem totam aspernatur rerum a temporibus nostrum iusto officiis at odit nesciunt, dolore velit facere fuga fugiat explicabo sit hic, consequatur obcaecati? Architecto necessitatibus sit tenetur reprehenderit ducimus ea, veritatis debitis rem eos velit quo accusantium laborum pariatur aspernatur fugit reiciendis amet.</p></div>
    <div class="int">
      <?php if($currentUser[0]['userID'] == $_SESSION['userID']) : ?>
        <button data-edit-profile-btn class="btn-1">Edit Profile</button>
        <?php endif; ?>
      <button data-add-friend class="btn-1">Add Friend</button>
      <button data-like-profile class="btn-1">Like</button>
    </div>
  </div>
</div>
</div>

<div data-edit-profile>
  <div>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="file" name="profilePicture" accept="image/*">
      <input type="file" name="banner" accept="image/*">
      <input type="text" name="bio">
      <button type="submit" name="submit"></button>
    </form>
    <?php
    if(isset($_POST['submit'])) {
      if(!$_FILES['profilePicture']['size'] == 0) {
        echo 'gg';
        $profilePicture = $files->renameImage($_FILES['profilePicture']);
        if($profilePicture !== false) {
          $pfp->updateProfilePicture($profilePicture);
          header("Location: ".URLROOT."page/main/home");
        }        
      }
      if(!$_FILES['banner']['size'] == 0) {
        $banner = $files->renameImage($_FILES['banner']);
        if($banner !== false) {
          $pfp->updateBanner($banner);
          header("Location: ".URLROOT."page/main/home");
        }
      }
    }
    ?>
  </div>
</div>