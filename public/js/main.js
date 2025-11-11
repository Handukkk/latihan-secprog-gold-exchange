// Authentication
function login(e) {
  e.preventDefault()
  const email = document.getElementById("loginEmail").value
  const password = document.getElementById("loginPassword").value

  if (email && password) {
    localStorage.setItem("user", JSON.stringify({ email, username: email.split("@")[0] }))
    localStorage.setItem("balance", "5000")
    window.location.href = "dashboard.php"
  }
}

function register(e) {
  e.preventDefault()
  const username = document.getElementById("registerUsername").value
  const email = document.getElementById("registerEmail").value
  const password = document.getElementById("registerPassword").value
  const confirmPassword = document.getElementById("registerConfirmPassword").value

  if (password !== confirmPassword) {
    showToast("Password tidak cocok!", "error")
    return
  }

  localStorage.setItem("user", JSON.stringify({ email, username }))
  localStorage.setItem("balance", "5000")
  showToast("Pendaftaran berhasil! Silakan login.")
  setTimeout(() => (window.location.href = "login.php"), 1500)
}


// Dashboard
function loadDashboard() {
  checkAuth()
  const balance = localStorage.getItem("balance") || "5000"
  if (document.getElementById("balanceAmount")) {
    document.getElementById("balanceAmount").textContent = Number.parseInt(balance).toLocaleString("id-ID")
  }
}

// Top Up
function setAmount(amount) {
  document.getElementById("topupAmount").value = amount
  updateTopupSummary()
}

function updateTopupSummary() {
  const amount = Number.parseInt(document.getElementById("topupAmount").value) || 0
  const fee = Math.ceil(amount * 0.02)
  const total = amount * 1000 + fee

  if (document.getElementById("summaryAmount")) {
    document.getElementById("summaryAmount").textContent = amount.toLocaleString("id-ID")
    document.getElementById("summarySubtotal").textContent = "Rp " + (amount * 1000).toLocaleString("id-ID")
    document.getElementById("summaryFee").textContent = "Rp " + fee.toLocaleString("id-ID")
    document.getElementById("summaryTotal").textContent = "Rp " + total.toLocaleString("id-ID")
  }
}

function submitTopup(e) {
  e.preventDefault()
  const amount = Number.parseInt(document.getElementById("topupAmount").value)

  if (amount < 100) {
    showToast("Jumlah minimum 100 koin!", "error")
    return
  }

  const fee = Math.ceil(amount * 0.02)
  const total = amount * 1000 + fee
  document.getElementById("modalTotal").textContent = "Rp " + total.toLocaleString("id-ID")
  document.getElementById("paymentModal").classList.remove("hidden")
}

function openTopupModal() {
  document.getElementById("topupModal").classList.remove("hidden")
  document.getElementById("topupModalAmount").value = ""
  updateTopupModalSummary()
}

function closeTopupModal() {
  document.getElementById("topupModal").classList.add("hidden")
}

function setTopupAmount(amount) {
  document.getElementById("topupModalAmount").value = amount
  updateTopupModalSummary()
}

function updateTopupModalSummary() {
  const amount = Number.parseInt(document.getElementById("topupModalAmount").value) || 0
  const fee = Math.ceil(amount * 0.02)
  const total = amount * 1000 + fee

  document.getElementById("topupModalSubtotal").textContent = "Rp " + (amount * 1000).toLocaleString("id-ID")
  document.getElementById("topupModalFee").textContent = "Rp " + fee.toLocaleString("id-ID")
  document.getElementById("topupModalTotal").textContent = "Rp " + total.toLocaleString("id-ID")
}

function submitTopupModal(e) {
  e.preventDefault()
  const amount = Number.parseInt(document.getElementById("topupModalAmount").value)

  if (amount < 100) {
    showToast("Jumlah minimum 100 koin!", "error")
    return
  }

  const currentBalance = Number.parseInt(localStorage.getItem("balance")) || 5000
  localStorage.setItem("balance", (currentBalance + amount).toString())

  closeTopupModal()
  showToast("✓ Top Up Berhasil! Saldo telah ditambahkan ke akun Anda.")
  document.getElementById("balanceAmount").textContent = (currentBalance + amount).toLocaleString("id-ID")
}

function closePaymentModal() {
  document.getElementById("paymentModal").classList.add("hidden")
}

function confirmPayment() {
  const amount = Number.parseInt(document.getElementById("topupAmount").value)
  const currentBalance = Number.parseInt(localStorage.getItem("balance")) || 5000
  localStorage.setItem("balance", (currentBalance + amount).toString())

  closePaymentModal()
  showToast("✓ Top Up Berhasil! Saldo telah ditambahkan ke akun Anda.")

  setTimeout(() => (window.location.href = "dashboard.php"), 1500)
}

// Withdraw - Bank Account Management
function showAddBankForm() {
  document.getElementById("addBankForm").classList.remove("hidden")
}

function hideAddBankForm() {
  document.getElementById("addBankForm").classList.add("hidden")
}

function addBankAccount() {
  const bankName = document.getElementById("bankName").value
  const accountNumber = document.getElementById("accountNumber").value
  const accountOwner = document.getElementById("accountOwner").value

  if (!bankName || !accountNumber || !accountOwner) {
    showToast("Lengkapi semua data rekening!", "error")
    return
  }

  const bankList = document.getElementById("bankAccountsList")
  const bankId = Date.now()

  const bankItem = document.createElement("label")
  bankItem.className =
    "flex items-center p-4 bg-slate-700 border border-slate-600 rounded-lg cursor-pointer hover:border-amber-500 transition"
  bankItem.innerHTML = `
    <input type="radio" name="selectedBank" value="${bankId}" class="w-4 h-4">
    <div class="ml-3 flex-1">
      <p class="text-white font-medium">${bankName} - ${accountNumber}</p>
      <p class="text-slate-400 text-sm">Atas Nama: ${accountOwner}</p>
    </div>
    <button type="button" onclick="removeBankAccount(${bankId})" class="text-red-400 hover:text-red-300 text-sm">Hapus</button>
  `

  bankList.appendChild(bankItem)

  document.getElementById("bankName").value = ""
  document.getElementById("accountNumber").value = ""
  document.getElementById("accountOwner").value = ""
  hideAddBankForm()
  showToast("Rekening berhasil ditambahkan!")
}

function removeBankAccount(bankId) {
  const bankList = document.getElementById("bankAccountsList")
  const items = bankList.querySelectorAll("label")
  items.forEach((item) => {
    const radio = item.querySelector("input[type='radio']")
    if (radio.value == bankId) {
      item.remove()
    }
  })
  showToast("Rekening berhasil dihapus!")
}

function submitWithdraw(e) {
  e.preventDefault()
  const amount = Number.parseInt(document.getElementById("withdrawAmount").value)
  const balance = Number.parseInt(localStorage.getItem("balance")) || 5000
  const selectedBank = document.querySelector("input[name='selectedBank']:checked")

  if (amount < 100) {
    showToast("Jumlah minimum 100 koin!", "error")
    return
  }

  if (amount > balance) {
    showToast("Saldo tidak cukup!", "error")
    return
  }

  if (!selectedBank) {
    showToast("Pilih rekening bank terlebih dahulu!", "error")
    return
  }

  localStorage.setItem("balance", (balance - amount).toString())
  document.getElementById("successMessage").classList.remove("hidden")
  document.getElementById("withdrawForm").style.opacity = "0.5"
  document.getElementById("withdrawForm").style.pointerEvents = "none"

  setTimeout(() => (window.location.href = "dashboard.php"), 2000)
}

function updateWithdrawSummary() {
  const amount = Number.parseInt(document.getElementById("withdrawAmount").value) || 0
  const fee = Math.ceil(amount * 0.015)
  const total = amount * 1000 - fee

  if (document.getElementById("withdrawSummaryAmount")) {
    document.getElementById("withdrawSummaryAmount").textContent = amount.toLocaleString("id-ID")
    document.getElementById("withdrawSummarySubtotal").textContent = "Rp " + (amount * 1000).toLocaleString("id-ID")
    document.getElementById("withdrawSummaryFee").textContent = "Rp " + fee.toLocaleString("id-ID")
    document.getElementById("withdrawSummaryTotal").textContent = "Rp " + total.toLocaleString("id-ID")
  }
}

function openWithdrawModal() {
  document.getElementById("withdrawModal").classList.remove("hidden")
  document.getElementById("withdrawModalAmount").value = ""
  loadWithdrawBanks()
  updateWithdrawModalSummary()
}

function closeWithdrawModal() {
  document.getElementById("withdrawModal").classList.add("hidden")
}

function toggleAddBankForm() {
  document.getElementById("addBankFormContainer").classList.toggle("hidden")
}

function addBankAccountModal() {
  const bankName = document.getElementById("withdrawBankName").value
  const accountNumber = document.getElementById("withdrawAccountNumber").value
  const accountOwner = document.getElementById("withdrawAccountOwner").value

  if (!bankName || !accountNumber || !accountOwner) {
    showToast("Lengkapi semua data rekening!", "error")
    return
  }

  const banks = JSON.parse(localStorage.getItem("banks")) || []
  banks.push({
    id: Date.now(),
    bankName,
    accountNumber,
    accountOwner,
  })
  localStorage.setItem("banks", JSON.stringify(banks))

  document.getElementById("withdrawBankName").value = ""
  document.getElementById("withdrawAccountNumber").value = ""
  document.getElementById("withdrawAccountOwner").value = ""
  toggleAddBankForm()
  loadWithdrawBanks()
  showToast("Rekening berhasil ditambahkan!")
}

function loadWithdrawBanks() {
  const bankList = document.getElementById("withdrawBankList")
  const banks = JSON.parse(localStorage.getItem("banks")) || []

  bankList.innerHTML = ""

  if (banks.length === 0) {
    bankList.innerHTML = '<p class="text-slate-400 text-sm">Belum ada rekening bank</p>'
    return
  }

  banks.forEach((bank) => {
    const label = document.createElement("label")
    label.className =
      "flex items-center p-3 bg-slate-700 border border-slate-600 rounded-lg cursor-pointer hover:border-amber-500 transition"
    label.innerHTML = `
      <input type="radio" name="selectedBank" value="${bank.id}" class="w-4 h-4">
      <div class="ml-3 flex-1">
        <p class="text-white font-medium text-sm">${bank.bankName} - ${bank.accountNumber}</p>
        <p class="text-slate-400 text-xs">Atas Nama: ${bank.accountOwner}</p>
      </div>
      <button type="button" onclick="removeBankAccountModal(${bank.id})" class="text-red-400 hover:text-red-300 text-xs">Hapus</button>
    `
    bankList.appendChild(label)
  })
}

function removeBankAccountModal(bankId) {
  let banks = JSON.parse(localStorage.getItem("banks")) || []
  banks = banks.filter((b) => b.id !== bankId)
  localStorage.setItem("banks", JSON.stringify(banks))
  loadWithdrawBanks()
  showToast("Rekening berhasil dihapus!")
}

function updateWithdrawModalSummary() {
  const amount = Number.parseInt(document.getElementById("withdrawModalAmount").value) || 0
  const fee = Math.ceil(amount * 0.015)
  const total = amount * 1000 - fee

  document.getElementById("withdrawModalSubtotal").textContent = "Rp " + (amount * 1000).toLocaleString("id-ID")
  document.getElementById("withdrawModalFee").textContent = "Rp " + fee.toLocaleString("id-ID")
  document.getElementById("withdrawModalTotal").textContent = "Rp " + total.toLocaleString("id-ID")
}

function submitWithdrawModal(e) {
  e.preventDefault()
  const amount = Number.parseInt(document.getElementById("withdrawModalAmount").value)
  const balance = Number.parseInt(localStorage.getItem("balance")) || 5000
  const selectedBank = document.querySelector("input[name='selectedBank']:checked")

  if (amount < 100) {
    showToast("Jumlah minimum 100 koin!", "error")
    return
  }

  if (amount > balance) {
    showToast("Saldo tidak cukup!", "error")
    return
  }

  if (!selectedBank) {
    showToast("Pilih rekening bank terlebih dahulu!", "error")
    return
  }

  localStorage.setItem("balance", (balance - amount).toString())
  closeWithdrawModal()
  showToast("✓ Withdraw Berhasil! Proses penarikan sedang diproses.")
  document.getElementById("balanceAmount").textContent = (balance - amount).toLocaleString("id-ID")
}

// Toast Notification
function showToast(message, type = "success") {
  const toast = document.getElementById("toast")
  const toastIcon = document.getElementById("toastIcon")
  const toastMessage = document.getElementById("toastMessage")

  toastIcon.textContent = type === "error" ? "✕" : "✓"
  toastMessage.textContent = message
  toast.classList.remove("hidden")

  setTimeout(() => toast.classList.add("hidden"), 3000)
}

// Mobile Menu Toggle
function toggleMobileMenu() {
  const sidebar = document.querySelector("aside")
  if (sidebar) {
    sidebar.classList.toggle("hidden")
  }
}

// Event Listeners
document.addEventListener("DOMContentLoaded", () => {

  const loginForm = document.getElementById("loginForm")
  if (loginForm) loginForm.addEventListener("submit", login)

  const registerForm = document.getElementById("registerForm")
  if (registerForm) registerForm.addEventListener("submit", register)

  const topupForm = document.getElementById("topupForm")
  if (topupForm) topupForm.addEventListener("submit", submitTopup)

  const topupAmount = document.getElementById("topupAmount")
  if (topupAmount) topupAmount.addEventListener("input", updateTopupSummary)

  const topupModalAmount = document.getElementById("topupModalAmount")
  if (topupModalAmount) topupModalAmount.addEventListener("input", updateTopupModalSummary)

  const withdrawForm = document.getElementById("withdrawForm")
  if (withdrawForm) withdrawForm.addEventListener("submit", submitWithdraw)

  const withdrawAmount = document.getElementById("withdrawAmount")
  if (withdrawAmount) withdrawAmount.addEventListener("input", updateWithdrawSummary)

  const withdrawModalAmount = document.getElementById("withdrawModalAmount")
  if (withdrawModalAmount) withdrawModalAmount.addEventListener("input", updateWithdrawModalSummary)
})
