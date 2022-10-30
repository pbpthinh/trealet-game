import React, { Component, useState } from "react";
import { sortableContainer, sortableElement } from "react-sortable-hoc";
import { arrayMoveImmutable } from "array-move";
import { Card } from "@mui/material";

const SortableItem = sortableElement(({ value }) => (
    <Card
        style={{
            zIndex: 999999,
            minWidth: 180,
            height: 120,
            paddingTop: 20,
            marginTop: 10,
            textAlign: "center",
            backgroundColor: "green",
        }}
    >
        {value?.text}
    </Card>
));

const SortableContainer = sortableContainer(({ children }) => {
    return <div style={{ width: "100%" }}>{children}</div>;
});

const QuestionColumn = (props) => {
    const { data, items, setItems } = props;

    const onSortEnd = ({ oldIndex, newIndex }) => {
        setItems(arrayMoveImmutable(items, oldIndex, newIndex));
    };

    return (
        <div style={{ display: "flex" }}>
            <div style={{ width: "100%" }}>
                {data?.option.map((v) => (
                    <Card
                        style={{
                            minWidth: 180,
                            height: 120,
                            paddingTop: 20,
                            marginTop: 10,
                            marginRight: 2,
                            textAlign: "center",
                            backgroundColor: "greenyellow",
                        }}
                    >
                        {v?.text}
                    </Card>
                ))}
            </div>
            <SortableContainer
                onSortEnd={onSortEnd}
                style={{ zIndex: 999999, width: "100%" }}
            >
                {items.map((value, index) => (
                    <SortableItem
                        key={`item-${value?.id}`}
                        index={index}
                        value={value}
                    />
                ))}
            </SortableContainer>
        </div>
    );
};
export default QuestionColumn;
