-- create table post
-- (
--     id      integer not null
--         constraint post_pk
--             primary key autoincrement,
--     subject text not null,
--     content text not null
-- );

create table shoppingList
(
    id      integer not null
        constraint shoppingList_pk
            primary key autoincrement,
    title text not null
);