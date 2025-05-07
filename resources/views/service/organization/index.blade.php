@extends('layouts.app')

@section('title', 'Organizational Management')

@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Enhanced UI Components */
        .org-badge {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 0.375rem;
            display: inline-block;
            min-width: 60px;
            text-align: center;
        }

        .org-badge-active {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }

        .org-badge-inactive {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .org-card {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
        }

        .org-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px rgb(0 0 0 / 0.1);
            border-color: #d1d5db;
        }

        .nav-pills .nav-link {
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            margin-right: 0.5rem;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .org-avatar {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            font-weight: bold;
            font-size: 1rem;
            background-color: #bfdbfe;
            color: #1e40af;
            user-select: none;
        }

        .action-btn {
            width: 1.75rem;
            height: 1.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #f3f4f6;
        }

        /* Responsive tables */
        .responsive-table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Buttons */
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-purple {
            background-color: #7c3aed;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #5b21b6;
        }

        /* Breadcrumb */
        nav[aria-label="Breadcrumb"] ol li a {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Table headers */
        table thead th {
            background-color: #1e40af; /* azul rey */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: white;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid #2563eb;
        }
        /* DataTables controls */
        .dataTables_wrapper .dataTables_filter {
            padding: 0.5rem 1rem;
            text-align: right;
        }
        .dataTables_wrapper .dataTables_paginate {
            padding: 0.5rem 1rem;
            text-align: right;
        }
        .dataTables_wrapper .dataTables_length {
            padding: 0.5rem 1rem;
        }

        /* Table cells */
        table tbody td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #374151;
        }

        /* Table row hover */
        table tbody tr:hover {
            background-color: #f3f4f6;
        }

        /* Modal improvements */
        .modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 700;
            font-size: 1.25rem;
            color: #111827;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 1rem 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        /* Form inputs */
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            color: #374151;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .flex-col-md-row {
                flex-direction: column !important;
            }

            .responsive-table-container {
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <!-- Breadcrumb Navigation -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-gray-600">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page" class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-500 font-medium">Organizations</span>
                </li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Organizational Management</h1>
                <p class="text-gray-600 mt-1">Manage your organizations, headquarters and units</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button data-modal-target="create-org-modal" data-modal-toggle="create-org-modal" type="button"
                    class="btn-primary">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Nueva Organización
                </button>
            </div>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-pills mb-6" id="orgTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="organizations-tab" data-bs-toggle="pill" data-bs-target="#organizations"
                    type="button" role="tab" aria-controls="organizations" aria-selected="true">
                    Organizations
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="headquarters-tab" data-bs-toggle="pill" data-bs-target="#headquarters"
                    type="button" role="tab" aria-controls="headquarters" aria-selected="false">
                    Headquarters
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="units-tab" data-bs-toggle="pill" data-bs-target="#units" type="button"
                    role="tab" aria-controls="units" aria-selected="false">
                    Units
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="orgTabsContent">
            <!-- Organizations Tab -->
            <div class="tab-pane fade show active pb-5" id="organizations" role="tabpanel" aria-labelledby="organizations-tab">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Listado de Organización</h2>
                    </div>

                    <div class="responsive-table-container">
                        <table id="organizations-table" class="w-full table-auto border-collapse border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Organization</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Headquarters</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Contact</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizations as $organization)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="org-avatar">
                                                    {{ substr($organization->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ $organization->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $organization->tax_id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $organization->headquarters->count() }} locations</div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $organization->contact_email }}</div>
                                            <div class="text-sm text-gray-500">{{ $organization->contact_phone }}</div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                            <span class="org-badge {{ $organization->status ? 'org-badge-active' : 'org-badge-inactive' }}">
                                                {{ $organization->status ? 'active' : 'inactive' }}
                                            </span>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-right">
                                            <div class="flex justify-end space-x-2">
                                                <button class="action-btn text-blue-600 hover:text-blue-900" title="Edit" onclick="editOrganization({{ $organization->id }})">
                                                    <i class="fa fa-pen-to-square"></i>
                                                </button>
                                                <button class="action-btn text-green-600 hover:text-green-900" title="View" onclick="showOrganizationModal({{ $organization->id }})">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="action-btn text-red-600 hover:text-red-900" title="Delete" onclick="confirmDelete('organization', {{ $organization->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Headquarters Tab -->
            <div class="tab-pane fade pb-5" id="headquarters" role="tabpanel" aria-labelledby="headquarters-tab">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Table View -->
                    <div class="flex-1 bg-white rounded-lg shadow overflow-hidden" id="headquarters-table-view">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-semibold text-gray-900">Listado de sedes</h2>
                            <div class="flex items-center space-x-3">
                                <button class="p-2 text-gray-500 hover:text-gray-700" id="toggle-headquarters-view" title="Toggle view">
                                    <i class="fa fa-th"></i>
                                </button>
                            </div>
                        </div>

                        <div class="responsive-table-container">
                            <table id="headquarters-table" class="w-full table-auto border-collapse border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Organization</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Headquarter</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Location</th>
                                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                        <th class="border border-gray-300 px-4 py-2 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organizations as $organization)
                                        @foreach ($organization->headquarters as $headquarter)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $organization->name }}</td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap font-medium text-gray-900">{{ $headquarter->name }}</td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $headquarter->address }}<br>
                                                    <span class="text-gray-500">{{ $headquarter->city }}, {{ $headquarter->state }}</span>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                                    <span class="org-badge {{ $headquarter->status == 'active' ? 'org-badge-active' : 'org-badge-inactive' }}">
                                                        {{ ucfirst($headquarter->status) }}
                                                    </span>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-right">
                                                    <div class="flex justify-end space-x-2">
                                                        <button class="action-btn text-blue-600 hover:text-blue-900" title="Edit" onclick="editHeadquarter({{ $headquarter->id }})">
                                                            <i class="fa fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="action-btn text-green-600 hover:text-green-900" title="View" onclick="viewHeadquarter({{ $headquarter->id }})">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Units Tab -->
            <div class="tab-pane fade" id="units" role="tabpanel" aria-labelledby="units-tab">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Organizational Units</h2>
                        <div class="flex items-center space-x-3">
                            <button data-modal-target="create-unit-modal" data-modal-toggle="create-unit-modal" type="button" class="btn-purple">
                                <i class="fa fa-plus mr-2"></i> Nueva unidad
                            </button>
                        </div>
                    </div>

                    <div class="responsive-table-container">
                        <table id="units-table" class="w-full table-auto border-collapse border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Unit</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Headquarter</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Manager</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($headquartersWithUnitTypes as $headquarter)
                                    @foreach ($headquarter->unitTypes as $unitType)
                                        @foreach ($unitType->units as $unit)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                                    <div class="font-medium text-gray-900">{{ $unit->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $unit->code }}</div>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        {{ $unitType->name }}
                                                    </span>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $headquarter->name }}
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                                                    @if ($unit->leaders->isNotEmpty())
                                                        @php
                                                            $currentLeader = $unit->leaders->first();
                                                        @endphp
                                                        <div>
                                                            {{ $currentLeader->person->name }}
                                                            <div class="text-xs text-gray-500">
                                                                Desde: {{ $currentLeader->pivot->start_date->format('d/m/Y') }}
                                                                @if ($currentLeader->pivot->end_date)
                                                                    <br>Hasta: {{ $currentLeader->pivot->end_date->format('d/m/Y') }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-red-500">Sin encargado</span>
                                                    @endif
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                                    <span class="org-badge {{ $unit->status ? 'org-badge-active' : 'org-badge-inactive' }}">
                                                        {{ $unit->status ? 'active' : 'inactive' }}
                                                    </span>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-right">
                                                    <div class="flex justify-end space-x-2">
                                                        <button class="action-btn text-blue-600 hover:text-blue-900" title="Edit" onclick="editUnit({{ $unit->id }})">
                                                            <i class="fa fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="action-btn text-green-600 hover:text-green-900" title="View" onclick="viewUnit({{ $unit->id }})">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('service.organization.modals.create-organization')
    @include('service.organization.modals.create-unit')
    {{-- @include('service.organization.modals.create-headquarter') --}}
@include('service.organization.modals.edit-organization')

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#organizations-table, #headquarters-table, #units-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                responsive: true,
                dom: '<"top"lf>rt<"bottom"ip><"clear">',
                pageLength: 10,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    }
                ]
            });

            // Toggle headquarters view between table and cards
            $('#toggle-headquarters-view').click(function() {
                $('#headquarters-table-view').toggleClass('hidden');
                $('#headquarters-card-view').toggleClass('hidden');

                const icon = $(this).find('i');
                if (icon.hasClass('fa-th')) {
                    icon.removeClass('fa-th').addClass('fa-list');
                    $(this).attr('title', 'Table view');
                } else {
                    icon.removeClass('fa-list').addClass('fa-th');
                    $(this).attr('title', 'Card view');
                }
            });

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            // Tab functionality
            const tabElms = document.querySelectorAll('button[data-bs-toggle="pill"]');
            tabElms.forEach(tabEl => {
                tabEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    const tabTarget = this.getAttribute('data-bs-target');
                    const tabPane = document.querySelector(tabTarget);

                    // Hide all panes
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });

                    // Deactivate all tabs
                    tabElms.forEach(tab => {
                        tab.classList.remove('active');
                        tab.setAttribute('aria-selected', 'false');
                    });

                    // Activate current tab
                    this.classList.add('active');
                    this.setAttribute('aria-selected', 'true');
                    tabPane.classList.add('show', 'active');

                    // Trigger resize event for DataTables
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
                });
            });
        });

        // Global action functions
        function confirmDelete(type, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: `This will permanently delete the ${type}. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/Eliminar/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `The ${type} has been deleted.`,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the ' + type + '.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function editOrganization(id) {
            $.ajax({
                url: `/organization/data/${id}`,
                type: 'GET',
                success: function(data) {
                    // Assuming the server returns JSON data of the organization
                    $('#edit_name').val(data.name);
                    $('#edit_tax_id').val(data.tax_id);
                    $('#edit_contact_email').val(data.contact_email);
                    $('#edit_contact_phone').val(data.contact_phone);
                    $('#edit-org-form').attr('action', `/Actualizar/${id}`);
                    // Show the modal
                    $('#edit-org-modal').removeClass('hidden');
                },
                error: function() {
                    Swal.fire('Error', 'Could not load organization data.', 'error');
                }
            });
        }

        function viewOrganization(id) {
            window.location.href = `/Mostrar/${id}`;
        }

        function editHeadquarter(id) {
            console.log('Edit headquarter with ID:', id);
        }

        function viewHeadquarter(id) {
            console.log('View headquarter with ID:', id);
        }

        function editUnit(id) {
            console.log('Edit unit with ID:', id);
        }

        function viewUnit(id) {
            console.log('View unit with ID:', id);
        }

        // Handle flash messages
        @if (session('success'))
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <script>
        function showAssignLeaderModal(unitId) {
            console.log("Asignar líder a unidad:", unitId);
            Swal.fire({
                title: 'Asignar encargado',
                text: 'Funcionalidad en desarrollo',
                icon: 'info'
            });
        }
    </script>
@endpush
