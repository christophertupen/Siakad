import sys

file_path = "resources/views/landing/home.blade.php"
with open(file_path, "r") as f:
    content = f.read()

# 1. Update body tag
content = content.replace(
    '''<body x-data="{ mobileMenuOpen: false, portalModalOpen: false, ppdbModalOpen: false }" :class="(portalModalOpen || ppdbModalOpen) ? 'overflow-hidden' : ''" @close-ppdb-modal.window="ppdbModalOpen = false">''',
    '''<body x-data="{ mobileMenuOpen: false, modalOpen: false, step: 1, role: '' }" :class="modalOpen ? 'overflow-hidden' : ''" @close-modal.window="modalOpen = false; step = 1; role = '';">'''
)

# 2. Update buttons
content = content.replace(
    '''<button @click="ppdbModalOpen = true"''',
    '''<button @click="modalOpen = true; step = 1; role = '';"'''
)
content = content.replace(
    '''<button @click="mobileMenuOpen = false; ppdbModalOpen = true"''',
    '''<button @click="mobileMenuOpen = false; modalOpen = true; step = 1; role = '';"'''
)
content = content.replace(
    '''<button @click="portalModalOpen = true"''',
    '''<button @click="modalOpen = true; step = 1; role = '';"'''
)
content = content.replace(
    '''Masuk Portal Akademik''',
    '''Daftar Sekarang'''
)

with open(file_path, "w") as f:
    f.write(content)

print("Replaced simple text")
