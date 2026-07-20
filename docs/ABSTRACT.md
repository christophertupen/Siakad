# ABSTRACT

**ScholaNexa: Web-Based Academic Information System for Senior High School**

Senior high schools and vocational schools still manage academic data manually or using separate media, causing scattered data, schedule conflicts, unstructured material distribution, manual payments, and limited report card access. This research aims to build a web-based academic information system that integrates the management of student data, teachers, classes, subjects, schedules, materials, assignments, grades, payments, report cards, and question banks in a single platform.

The system was developed using Laravel 12 framework, PHP 8.3, MariaDB database, and user interface using Blade, Tailwind CSS, Livewire v3, and Filament v3. The system implements a multi-role architecture with five separate panels for Admin, Academic/Administration Staff, Teachers, Students, and Parents using Spatie Permission. Online payments are integrated with Midtrans through Snap API and webhook. Development used the Agile method with four iterations.

Implementation results show that the system successfully provides self-registration with email verification, multi-role login, centralized academic data management, automatic schedule conflict validation, online material and assignment management, grade input with change history, online report card access through PDF upload, Midtrans-integrated online payments, and question banks for SNBT preparation. The system was tested using black-box testing and user acceptance testing.

**Keywords:** academic information system, Laravel, Filament, Midtrans, school management
