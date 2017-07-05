<?php

class PluginTest extends WP_UnitTestCase {
 /**
 * @test
 *
 * This test will ensure the plugin loads without error
 */
  function itShouldBeLoaded() {
    $this->assertEquals(function_exists('wp_user_themes'), true);
  }
  
 /**
 * @test
 *
 * This test will ensure we receieve the same value back for a theme
 */
  function itShouldBeTheSameTheme() {
    $this->assertEquals(wp_user_themes('twentyfourteen'), 'twentyfourteen');
  }
  
 /**
 * @test
 *
 * This test will ensure we receieve the same value back for a theme (using get_option)
 */
  function itShouldBeTheSameThemeUsingGetOptionTemplate() {
    $this->assertEquals(get_option('template'), 'default');
  }
  
 /**
 * @test
 *
 * This test will ensure we receieve the same value back for a theme (using get_option)
 */
  function itShouldBeTheSameThemeUsingGetOptionStylesheet() {
    $this->assertEquals(get_option('stylesheet'), 'default');
  }
  
 /**
 * @test
 *
 * This test will ensure we receieve the same value back for a theme (using get_template)
 */
  function itShouldBeTheSameThemeUsingGetTemplate() {
    $this->assertEquals(get_template(), 'default');
  }
  
 /**
 * @test
 *
 * This test will ensure a user who has no theme set, has empty metadata
 */
  function itShouldReturnEmptyForUserWithNoThemeSelectedYet() {
    $user  = $this->factory->user->create_and_get();
    $theme = get_user_meta($user->ID, 'user_theme', true);
    
    $this->assertEquals($theme, '');
  }
  
 /**
 * @test
 * @runInSeparateProcess
 *
 * This test will ensure a user who has a theme set, gets same theme back (get_option template)
 */
  function itShouldReturnTheUsersThemeUsingGetOptionTemplate() {
    global $current_user;
    
    $create_user  = $this->factory->user->create_and_get();
  	$current_user = wp_signon([
      'user_login' => $create_user->user_login,
      'user_password' => 'password'
    ], false);
    update_user_meta($current_user->ID, 'user_theme', 'phpunit_theme');

    $this->assertEquals('phpunit_theme', get_option('template'));
  }
  
 /**
 * @test
 * @runInSeparateProcess
 *
 * This test will ensure a user who has a theme set, gets same theme back (get_option stylesheet)
 */
  function itShouldReturnTheUsersThemeUsingGetOptionStylesheet() {
    global $current_user;
    
    $create_user  = $this->factory->user->create_and_get();
	  $current_user = wp_signon([
      'user_login' => $create_user->user_login,
      'user_password' => 'password'
    ], false);
    update_user_meta($current_user->ID, 'user_theme', 'phpunit_theme');

    $this->assertEquals('phpunit_theme', get_option('stylesheet'));
  }
  
 /**
 * @test
 * @runInSeparateProcess
 *
 * This test will ensure a user who has a theme set, gets same theme back (get_template)
 */
  function itShouldReturnTheUsersThemeUsingGetTemplate() {
    global $current_user;
    
    $create_user  = $this->factory->user->create_and_get();
	  $current_user = wp_signon([
      'user_login' => $create_user->user_login,
      'user_password' => 'password'
    ], false);
    update_user_meta($current_user->ID, 'user_theme', 'phpunit_theme');

    $this->assertEquals('phpunit_theme', get_template());
  }
  
 /**
 * @test
 * @runInSeparateProcess
 *
 * This test will ensure a user who has no theme set, gets default theme back (get_option stylesheet)
 */
  function itShouldReturnDefaultThemeForUserWithNoThemeSelectedYetUsingGetOptionStylesheet() {
    global $current_user;
    
    $create_user  = $this->factory->user->create_and_get();
	  $current_user = wp_signon([
      'user_login' => $create_user->user_login,
      'user_password' => 'password'
    ], false);

    $this->assertEquals(get_option('stylesheet'), 'default');
  }
  
 /**
 * @test
 * @runInSeparateProcess
 *
 * This test will ensure a user who has no theme set, gets default theme back (get_option template)
 */
  function itShouldReturnDefaultThemeForUserWithNoThemeSelectedYetUsingGetOptionTemplate() {
    global $current_user;
    
    $create_user  = $this->factory->user->create_and_get();
	  $current_user = wp_signon([
      'user_login' => $create_user->user_login,
      'user_password' => 'password'
    ], false);

    $this->assertEquals(get_option('template'), 'default');
  }
  
 /**
 * @test
 * @runInSeparateProcess
 *
 * This test will ensure a user who has no theme set, gets default theme back (get_template)
 */
  function itShouldReturnDefaultThemeForUserWithNoThemeSelectedYetUsingGetTemplate() {
    global $current_user;
    
    $create_user  = $this->factory->user->create_and_get();
	  $current_user = wp_signon([
      'user_login' => $create_user->user_login,
      'user_password' => 'password'
    ], false);

    $this->assertEquals(get_template(), 'default');
  }
}

