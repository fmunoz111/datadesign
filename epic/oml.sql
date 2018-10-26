alter database fmunoz11 character set utf8 collate utf8_unicode_ci;
create table patient(
    -> patientId binary(16) not null,
    -> patientProfileId varchar(32) not null,
    -> patientEmail varchar(128) not null,
    -> patientUsername varchar(32) not null,
    -> patientInformation varchar(255) not null,
    -> unique(patientEmail),
    -> unique(patientUsername),
    -> primary key(patientId)
    -> );

create table provider(
    -> providerId binary(16) not null,
    -> providerEmail varchar(32) not null,
    -> providerVisits binary(16) not null,
    -> providerRating binary(16) not null,
    -> prodiverReviews varchar(132) not null,
    -> unique(providerId)
    -> ,
    -> unique(providerEmail)
    -> ,
    -> primary key(providerId)
    -> );

create table physician(
    -> physicianId binary(16),
    -> physicianEmail varchar(32),
    -> physicianScheduletime varchar(32)
    -> ,
    -> physicianDate datetime(6),
    -> physicianRating binary(6),
    -> physicianComment varchar(255),
    -> unique(physicianId),
    -> unique(physicianEmail),
    -> primary key(physicianId)
    -> );

create table comment(
    -> commentPatientId binary(16),
    -> commentProviderId binary(16),
    -> commentPhysicianId binary(16),
    -> commentDate datetime(6),
    -> commentContent varchar(255),
    ->
    -> index(commentPatientId),
    -> foreign key(commentPatientId) references patient(patientId),
    -> index(commentProviderId),
    -> foreign key(commentProviderId) references provider(providerId),
    -> index(commentPhysicianId),
    -> foreign key(commentPhysicianId) references physician(physicianId)
    -> );

insert into patient(patientId, patientProfileId, patientEmail, patientUsername, patientInformation) values(unhex("5d85dd1a70a64eaaaf6dd53a00b063b5"), unhex("9e8834c750694ce6aff279b97b170310"), "susang01@gmail.com", "susg01", "Susan is a 22 year old student with no insurance and she is looking for an OBGYN in the Albuquerque area.");

insert into physician(physicianId, physicianEmail, physicianScheduletime, physicianDate, physicianRating, physicianComment) values(unhex("128ca157f7f2430eb206f5ce53488a7a"), "Drjoe@gmail.com", "Available Schedule Times", "2018-10-10 12:12:12.12", "8/10", "physician comments will go here" );

INSERT INTO provider (providerId, providerEmail, providerVisits, providerRating, prodiverReviews) VALUES (unhex("d5886f87d95148bb94ff637587b11c69"), "abqobgyn@gmail.com", "number of vists", "9/10","reviews will go here");

insert into comment(commentPatientId, commentProviderId, commentPhysicianId, commentDate, commentContent) values (unhex("5d85dd1a70a64eaaaf6dd53a00b063b5"), unhex("d5886f87d95148bb94ff637587b11c69"), unhex("128ca157f7f2430eb206f5ce53488a7a"), "2018-10-10 12:12:12.12", "Comment content will go here");

update provider set providerEmail ="obgynabq@gmabq@yahoo.com", providerId = unhex("d5886f87d95148bb94ff637587b11c69");

update provider set providerRating="7/10" where providerId = unhex("d5886f87d95148bb9

select * from patient;





