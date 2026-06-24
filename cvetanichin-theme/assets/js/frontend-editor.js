/**
 * Cvetanichin Theme — Front-End Inline Editor
 * Allows logged-in users to edit page fields directly on the frontend
 * with pencil icons and AJAX saves to post meta.
 */

(function() {
  'use strict';

  if (typeof cvetanichinedit === 'undefined') return;

  // ── Initialization ──────────────────────────────────────────────────────
  document.addEventListener('DOMContentLoaded', function() {
    initInlineEditor();
  });

  function initInlineEditor() {
    const editables = document.querySelectorAll('[data-meta-key]');

    editables.forEach(el => {
      el.classList.add('cv-editable');
      el.addEventListener('click', handleEditableClick);
    });
  }

  // ── Click Handler ───────────────────────────────────────────────────────
  function handleEditableClick(e) {
    // Prevent triggering edit if clicking on existing buttons/inputs
    if (e.target.closest('.cv-editor-controls') || e.target.closest('.cv-editor-input')) {
      return;
    }

    const element = e.currentTarget;
    const fieldKey = element.dataset.metaKey;
    const fieldType = element.dataset.fieldType || 'text';

    if (!fieldKey) return;

    e.preventDefault();
    e.stopPropagation();

    activateEditMode(element, fieldKey, fieldType);
  }

  // ── Activate Edit Mode ──────────────────────────────────────────────────
  function activateEditMode(element, fieldKey, fieldType) {
    // Don't activate if already editing
    if (element.classList.contains('cv-editing')) return;

    const originalValue = getFieldValue(element);

    if (fieldType === 'image') {
      handleImageUpload(element, fieldKey);
      return;
    }

    element.classList.add('cv-editing');

    // Create editor container
    const editor = document.createElement('div');
    editor.className = 'cv-editor-wrapper';

    // Create input field based on type
    let inputElement;

    if (fieldType === 'textarea') {
      inputElement = document.createElement('textarea');
      inputElement.className = 'cv-editor-input cv-editor-textarea';
      inputElement.value = originalValue;
      inputElement.rows = 4;
    } else {
      inputElement = document.createElement('input');
      inputElement.type = 'text';
      inputElement.className = 'cv-editor-input';
      inputElement.value = originalValue;
    }

    // Create control buttons
    const controls = document.createElement('div');
    controls.className = 'cv-editor-controls';

    const saveBtn = document.createElement('button');
    saveBtn.className = 'cv-editor-button cv-editor-save';
    saveBtn.textContent = 'Save';
    saveBtn.addEventListener('click', () => {
      saveField(element, fieldKey, inputElement.value, originalValue);
    });

    const cancelBtn = document.createElement('button');
    cancelBtn.className = 'cv-editor-button cv-editor-cancel';
    cancelBtn.textContent = 'Cancel';
    cancelBtn.addEventListener('click', () => {
      cancelEdit(element, originalValue);
    });

    controls.appendChild(saveBtn);
    controls.appendChild(cancelBtn);

    // Clear element and insert editor
    element.innerHTML = '';
    element.appendChild(inputElement);
    element.appendChild(controls);

    // Focus input
    inputElement.focus();
    inputElement.select();

    // Allow Enter to save (for single-line text)
    if (fieldType === 'text') {
      inputElement.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          saveBtn.click();
        }
      });
    }
  }

  // ── Get Field Value ────────────────────────────────────────────────────
  function getFieldValue(element) {
    // If element has data-value attribute, use it
    if (element.dataset.value) {
      return element.dataset.value;
    }

    // For text/heading elements, get inner text
    if (element.tagName === 'H1' || element.tagName === 'H2' ||
        element.tagName === 'H3' || element.tagName === 'P' ||
        element.tagName === 'SPAN') {
      return element.textContent.trim();
    }

    // For images, get alt text or src
    if (element.tagName === 'IMG') {
      return element.src;
    }

    // Fallback
    return element.textContent.trim();
  }

  // ── Save Field ──────────────────────────────────────────────────────────
  function saveField(element, fieldKey, newValue, originalValue) {
    // Validate not empty
    if (!newValue || newValue.trim() === '') {
      alert('Field cannot be empty');
      return;
    }

    // Show loading state
    element.classList.add('cv-editor-loading');

    // Build AJAX request
    const formData = new FormData();
    formData.append('action', 'cvetanichin_save_field');
    formData.append('nonce', cvetanichinedit.nonce);
    formData.append('post_id', cvetanichinedit.postid);
    formData.append('field_key', fieldKey);
    formData.append('field_value', newValue);

    fetch(cvetanichinedit.ajaxurl, {
      method: 'POST',
      body: formData,
      credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
      element.classList.remove('cv-editor-loading');

      if (data.success) {
        // Update DOM with new value
        updateFieldDisplay(element, newValue);

        // Show success indicator
        element.classList.add('cv-editor-success');
        setTimeout(() => {
          element.classList.remove('cv-editor-success');
        }, 2000);
      } else {
        alert('Error saving field: ' + (data.data || 'Unknown error'));
        // Restore original value
        updateFieldDisplay(element, originalValue);
      }

      element.classList.remove('cv-editing');
    })
    .catch(error => {
      console.error('AJAX error:', error);
      alert('Network error: ' + error.message);
      element.classList.remove('cv-editor-loading');
      element.classList.remove('cv-editing');
      updateFieldDisplay(element, originalValue);
    });
  }

  // ── Update Field Display ────────────────────────────────────────────────
  function updateFieldDisplay(element, value) {
    element.innerHTML = '';

    const fieldType = element.dataset.fieldType || 'text';

    if (fieldType === 'textarea') {
      // Preserve line breaks
      element.textContent = value;
    } else if (fieldType === 'image') {
      const img = document.createElement('img');
      img.src = value;
      img.alt = element.dataset.metaKey;
      element.appendChild(img);
    } else {
      element.textContent = value;
    }
  }

  // ── Handle Image Upload ────────────────────────────────────────────────
  function handleImageUpload(element, fieldKey) {
    // Check if wp.media is available
    if (typeof wp === 'undefined' || typeof wp.media === 'undefined') {
      alert('WordPress media library not available');
      return;
    }

    const frame = wp.media({
      title: 'Select Image',
      button: {
        text: 'Use this image'
      },
      multiple: false
    });

    frame.on('select', function() {
      const attachment = frame.state().get('selection').first().toJSON();
      const imageUrl = attachment.url;

      // Save immediately
      saveImageField(element, fieldKey, imageUrl);
    });

    frame.open();
  }

  // ── Save Image Field ────────────────────────────────────────────────────
  function saveImageField(element, fieldKey, imageUrl) {
    element.classList.add('cv-editor-loading');

    const formData = new FormData();
    formData.append('action', 'cvetanichin_save_field');
    formData.append('nonce', cvetanichinedit.nonce);
    formData.append('post_id', cvetanichinedit.postid);
    formData.append('field_key', fieldKey);
    formData.append('field_value', imageUrl);

    fetch(cvetanichinedit.ajaxurl, {
      method: 'POST',
      body: formData,
      credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
      element.classList.remove('cv-editor-loading');

      if (data.success) {
        updateFieldDisplay(element, imageUrl);
        element.classList.add('cv-editor-success');
        setTimeout(() => {
          element.classList.remove('cv-editor-success');
        }, 2000);
      } else {
        alert('Error uploading image: ' + (data.data || 'Unknown error'));
      }
    })
    .catch(error => {
      console.error('AJAX error:', error);
      alert('Network error: ' + error.message);
      element.classList.remove('cv-editor-loading');
    });
  }

  // ── Cancel Edit ────────────────────────────────────────────────────────
  function cancelEdit(element, originalValue) {
    element.classList.remove('cv-editing');
    updateFieldDisplay(element, originalValue);
  }

})();
