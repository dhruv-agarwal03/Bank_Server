Create Table AcountTypes
(
	aid int auto_increment primary key,
	accounttype varchar(30)
);
Create Table Branches
(
	bcode int primary key,
	branchname varchar(30),	
	address varchar(50),
	state varchar(30),
	city varchar(30),
	pincode varchar(6),
	contactno1 varchar(30),
	contactno2 varchar(30),
	email varchar(40)
);
Create Table Customers
(
	accountno varchar(20) primary key,
	fname varchar(50),
	lname varchar(50),
	dob date,
	father varchar(50),
	mother varchar(50),
	spouse varchar(50),
	address varchar(50),
	state varchar(30),
	city varchar(30),
	pincode varchar(6),
	mobile char(10),
	email varchar(40),
	gender char(1),
	aadhar char(12),
	pan char(10),
	nominee varchar(30),
	nomineerelation varchar(30),
	nomineedob date	
);
Create Table CustomerDocuments
(
	accountno varchar(20) references Customers(accountno),
	doctype varchar(20),	
	document mediumblob,
	remark varchar(20)
);
Create Table BankTransactions
(
	tid int auto_increment primary key,
	tdate date,
	accountno varchar(20),
	amount float,
	ttype varchar(2),
	tdetails varchar(100),
	foreign key(accountno) references Customers(accountno)
);
Create Table Users
(
	ulogin varchar(100) primary key,
	upass varchar(100),
	branch int,
	utype varchar(100),
	cdate date,
	lastlogindate date,
	status varchar(1)
);
insert into users values('admin1','admin','1001','Administrator','2025-2-1','2025-2-1','Y');
insert into users values('admin2','admin','1002','Administrator','2025-2-1','2025-2-1','Y');
insert into users values('admin3','admin','1003','Administrator','2025-2-1','2025-2-1','Y');
insert into AcountTypes(accounttype) values('Saving Account');
insert into AcountTypes(accounttype) values('Saving-Salary Account');
insert into AcountTypes(accounttype) values('Saving-Women Account');
insert into AcountTypes(accounttype) values('Saving-Senior Account');
insert into AcountTypes(accounttype) values('Current-Platinum Account');
insert into AcountTypes(accounttype) values('Current-Silver Account');
insert into AcountTypes(accounttype) values('Current-Gold Account');
insert into AcountTypes(accounttype) values('Recurring Deposit');
insert into AcountTypes(accounttype) values('Fixed Deposit');
insert into AcountTypes(accounttype) values('Fixed Deposit Saver');
insert into AcountTypes(accounttype) values('2 Wheeler Loan');
insert into AcountTypes(accounttype) values('4 Wheeler Loan');
insert into AcountTypes(accounttype) values('Home Loan');
insert into AcountTypes(accounttype) values('Housing Loan');
insert into Branches values(1001,'Meerut Main','Begum Bridge','Uttar Pradesh','Meerut','250001','8528528528','','meerutmain@abcbank.com');
insert into Branches values(1002,'Shastri Nagar','Garh Road Shastri Nagar','Uttar Pradesh','Meerut','250004','8528528529','','meerut1@abcbank.com');
insert into Branches values(1003,'Mawana','Mawana','Uttar Pradesh','Meerut','250014','8528528520','','meerut2@abcbank.com');
