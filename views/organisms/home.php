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
    <div class="bio"><p><?php echo $currentProfile[0]['bio']; ?></p></div>
    <div class="int">
      <?php if($currentUser[0]['userID'] == $_SESSION['userID']) : ?>
        <button data-popup-open="edit-profile" class="btn-1">Edit Profile</button>
      <?php endif; ?>
      <?php if($currentUser[0]['userID'] != $_SESSION['userID']) : ?>
        <?php if($user->checkFriendship($currentUser[0]['userID'])) : ?>
        <button data-add-friend class="btn-1">Add Friend</button>
        <?php elseif ($user->checkFriendship($currentUser[0]['userID']) == false) : ?>
        <button data-unfriend class="btn-1">unfriend</button>
        <button data-like-profile class="btn-1">Like</button>
        <?php endif; ?>
      <?php endif; ?>
      <p data-like-counter><?php echo $pfp->getUserProfile()[0]['likes'] ?></p>
    </div>
  </div>
</div>
</div>
<?php if($currentUser[0]['userID'] == $_SESSION['userID']) : ?>
  <dialog data-popup="edit-profile">
    <form class="edit-profile" action="" method="post" enctype="multipart/form-data">
      <input type="file" name="profilePicture" accept="image/*">
      <input type="file" name="banner" accept="image/*">
      <input type="text" name="bio">
      <button type="submit" name="submit"></button>
      <button class="btn-1" data-popup-close="edit-profile">close</button>
    </form>
    <?php
    if(isset($_POST['submit'])) {
      if(!$_FILES['profilePicture']['size'] == 0) {
        $profilePicture = $files->renameImage($_FILES['profilePicture']);
        if($profilePicture !== false) {
          $pfp->updateProfilePicture($profilePicture);
          header("Location: ".URLROOT."page/main/home");
        }        
      }
      if(!$_FILES['banner']['size'] == 0) {
        $banner = $files->renameImage($_FILES['banner']);
        if($banner !== false) {
          $pfp->updateBackgroundImage($banner);
          header("Location: ".URLROOT."page/main/home");
        }
      }
      if(!empty($_POST['bio'])) {
        $pfp->updateBio($_POST['bio']);
        header("Location: ".URLROOT."page/main/home");
      }
    }
    ?>
  </dialog>
<?php endif; ?>