//toggle selector class
export const itemToggleClass = (parent, selector, selectorClass) => {
    $(parent + selector).toggleClass(selectorClass);
}

//toggle siblings class
export const itemToggleSiblingsClass = (parent, selector, selectorClass) => {

    $(parent + selector).siblings().toggleClass(selectorClass);
}

//remove siblings class
export const itemRemoveSiblingsClass = (parent, selector, selectorClass) => {

    $(parent + selector).siblings().removeClass(selectorClass);
}
