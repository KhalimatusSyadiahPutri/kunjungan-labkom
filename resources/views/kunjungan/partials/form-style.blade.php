<style>
    /* Card & Form Styles */
    .form-card {
        border: none !important;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1) !important;
        background: #fff;
        transition: transform 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-5px);
    }

    .form-card .card-header {
        background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .form-card .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    }

    .form-card .card-body {
        padding: 2.5rem;
        background: #fff;
    }

    /* Form Controls */
    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        font-size: 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
        background-color: #fff;
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: #adb5bd;
        font-size: 0.95rem;
    }

    .form-label {
        color: #495057;
        margin-bottom: 0.7rem;
        font-size: 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label i {
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    /* Button Styles */
    .btn-submit {
        width: 100%;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            rgba(255,255,255,0) 0%,
            rgba(255,255,255,0.2) 50%,
            rgba(255,255,255,0) 100%
        );
        transition: all 0.5s ease;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(30, 60, 114, 0.3);
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    /* Modal Styles */
    .modal {
        backdrop-filter: blur(8px);
    }

    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        border: none;
        padding: 1.5rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border: none;
        padding: 1.5rem;
    }

    /* Table Styles */
    .table-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
    }

    .table th {
        background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        border: none;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e0e0e0;
        font-size: 0.95rem;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    .table .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .form-card .card-body {
            padding: 1.5rem;
        }

        .form-control, .form-select {
            font-size: 0.95rem;
        }

        .table-container {
            padding: 1rem;
            margin: 1rem 0;
        }

        .table th, .table td {
            padding: 0.75rem;
            font-size: 0.9rem;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-card, .table-container {
        animation: fadeInUp 0.5s ease-out;
    }
</style> 