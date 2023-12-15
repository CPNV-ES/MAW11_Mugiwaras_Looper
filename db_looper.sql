create table if not exists exercises
(
    id_exercise    int auto_increment
        primary key,
    title_exercise varchar(150)                             not null,
    status         enum ('Building', 'Answering', 'Closed') not null
);

create table if not exists fields
(
    id_field    int auto_increment
        primary key,
    label       text                                                   not null,
    value_kind  enum ('single_line', 'single_line_list', 'multi_line') not null,
    id_exercise int                                                    not null,
    constraint fields_ibfk_1
        foreign key (id_exercise) references exercises (id_exercise)
            on delete cascade
);

create table if not exists fulfillments
(
    id_fulfillment int auto_increment
        primary key,
    submited_at    datetime default CURRENT_TIMESTAMP not null,
    id_exercise    int                                not null,
    constraint fulfillments_ibfk_1
        foreign key (id_exercise) references exercises (id_exercise)
            on delete cascade
);

create table if not exists answers
(
    id_answer      int auto_increment
        primary key,
    answer         varchar(255) null,
    id_fulfillment int          not null,
    id_field       int          not null,
    constraint answers_ibfk_1
        foreign key (id_fulfillment) references fulfillments (id_fulfillment),
    constraint answers_ibfk_2
        foreign key (id_field) references fields (id_field)
            on delete cascade
);

create index id_fulfillment
    on answers (id_fulfillment);

