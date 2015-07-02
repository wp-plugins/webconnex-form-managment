<div id="wx_popup_container">
  <div class="wx_popup_container">
    <h2>WebConnex Form Management</h2>
    <label for="wx-url">Form URL:</label> <input type="text" name="wx-url" id="wx-url">
    <label for="wx-type">Type:</label>
    <select name="wx-type" id="wx-type">
      <option value="link">Button - Link to WebConnex</option>
      <option value="modal">Popup - Modal screen on your site</option>
      <option value="embed">Embedded - Form on your site</option>
    </select>
    <fieldset class="wx-type-options">
      <label for="wx-button-text">Button Text:</label> <input type="text" name="wx-button-text" id="wx-button-text">
      <label for="wx-button-color">Button Text Color:</label> <input type="text" name="wx-button-color" id="wx-button-color" class="wx-color-picker" value="#FFFFFF">
      <label for="wx-button-background">Button Background Color:</label> <input type="text" name="wx-button-background" id="wx-button-background" class="wx-color-picker" value="#7BB045">
    </fieldset>
    <button onclick="wx_add_shortcode();return false;" class="browser button button-hero" id="wx-add-form-button">Add Form</button>
  </div>
</div>