document.addEventListener('DOMContentLoaded', function () {
  var logoutTriggers = document.querySelectorAll('[data-admin-logout]');

  if (!logoutTriggers.length) {
    return;
  }

  function getLogoutModal() {
    var logoutModal = document.getElementById('adminLogoutModal');

    if (logoutModal) {
      return logoutModal;
    }

    logoutModal = document.createElement('div');
    logoutModal.id = 'adminLogoutModal';
    logoutModal.className = 'modal fade admin-logout-modal';
    logoutModal.tabIndex = -1;
    logoutModal.setAttribute('role', 'dialog');
    logoutModal.setAttribute('aria-labelledby', 'adminLogoutTitle');
    logoutModal.innerHTML = '<div class="modal-dialog modal-dialog-centered" role="document">' +
      '<div class="modal-content"><div class="modal-body">' +
      '<div class="admin-logout-modal__icon"><i class="fa-solid fa-right-from-bracket"></i></div>' +
      '<h5 class="modal-title" id="adminLogoutTitle">Keluar dari akun?</h5>' +
      '<p class="admin-logout-modal__text">Sesi Anda akan diakhiri. Anda perlu login kembali untuk mengakses sistem.</p>' +
      '<div class="admin-logout-modal__actions">' +
      '<button type="button" class="admin-logout-modal__cancel" id="adminLogoutCancel">Batal</button>' +
      '<a href="logout.php" class="admin-logout-modal__confirm">Ya, Logout</a>' +
      '</div></div></div></div>';
    document.body.appendChild(logoutModal);
    return logoutModal;
  }

  document.addEventListener('click', function (event) {
    if (!event.target.closest('#adminLogoutCancel')) {
      return;
    }

    var logoutModal = document.getElementById('adminLogoutModal');
    if (!logoutModal) {
      return;
    }

    if (typeof window.jQuery !== 'undefined' && typeof window.jQuery.fn.modal === 'function') {
      window.jQuery(logoutModal).modal('hide');
    } else {
      logoutModal.classList.remove('show');
      logoutModal.style.display = 'none';
      logoutModal.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('modal-open');
    }
  });

  logoutTriggers.forEach(function (trigger) {
    trigger.addEventListener('click', function (event) {
      event.preventDefault();
      var logoutModal = getLogoutModal();

      if (typeof window.jQuery !== 'undefined' && typeof window.jQuery.fn.modal === 'function') {
        window.jQuery(logoutModal).modal('show');
      } else {
        logoutModal.classList.add('show');
        logoutModal.style.display = 'block';
        logoutModal.removeAttribute('aria-hidden');
        document.body.classList.add('modal-open');
      }
    });
  });
});
